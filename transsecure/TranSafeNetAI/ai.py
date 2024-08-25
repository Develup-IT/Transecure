import pandas as pd
from sklearn.ensemble import IsolationForest
from sqlalchemy import create_engine

# Load the transaction data from CSV
df = pd.read_csv('transactions.csv')

# Feature engineering
# For simplicity, let's assume we only consider 'amount' as a feature
df['average_transaction_amount'] = df.groupby('sender_account')['amount'].transform('mean')
df['std_transaction_amount'] = df.groupby('sender_account')['amount'].transform('std')

# Select features for training
features = ['amount', 'average_transaction_amount', 'std_transaction_amount']

# Initialize Isolation Forest model
model = IsolationForest(contamination=0.01)  # Contamination is the expected proportion of outliers

# Train the model
model.fit(df[features])

# Connect to the online database
db_url = 'your_database_url'
username = 'your_username'
password = 'your_password'
engine = create_engine(f'{db_url}?user={username}&password={password}')

while True:
    # Query recent transaction data from the online database
    sql_query = """
    SELECT sender_name, receiver_name, amount, date_time
    FROM transactions
    WHERE date_time >= NOW() - INTERVAL 1 HOUR
    """
    new_df = pd.read_sql(sql_query, engine)

    if not new_df.empty:
        # Feature engineering on new data
        new_df['average_transaction_amount'] = new_df.groupby('sender_account')['amount'].transform('mean')
        new_df['std_transaction_amount'] = new_df.groupby('sender_account')['amount'].transform('std')

        # Anomaly detection on new data
        new_df['is_outlier'] = model.predict(new_df[features])

        # Identify suspicious transactions
        suspicious_transactions = new_df[new_df['is_outlier'] == -1]

        # Take appropriate actions based on suspicious transactions
        if not suspicious_transactions.empty:
            print("Anomaly detected: Suspicious transactions")
            print(suspicious_transactions)
            # Take appropriate actions (e.g., notify the user or administrator)
