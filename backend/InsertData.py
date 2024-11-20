import csv
import pymysql
import os

# Database configuration
db_host = "cpsc-440-rds.cj24gusco7ni.us-east-2.rds.amazonaws.com"
db_user = "admin"
db_password = "CPSC440password"
db_name = "CPSC440"

def insert_data_to_table(csv_file_path):
    # Extract table name from CSV file name
    table_name = os.path.splitext(os.path.basename(csv_file_path))[0]

    # Connect to the RDS MySQL database
    connection = pymysql.connect(
        host=db_host,
        user=db_user,
        password=db_password,
        database=db_name
    )

    try:
        with connection.cursor() as cursor:
            # Disable foreign key checks
            cursor.execute("SET FOREIGN_KEY_CHECKS = 0;")

            # Open the CSV file and read its content
            with open(csv_file_path, mode='r') as file:
                csv_reader = csv.reader(file)
                headers = next(csv_reader)  # Get column names from the first row

                # Construct the dynamic INSERT query
                insert_query = f"""
                INSERT INTO {table_name} ({', '.join(headers)})
                VALUES ({', '.join(['%s'] * len(headers))})
                """

                for row in csv_reader:
                    cursor.execute(insert_query, row)

            # Re-enable foreign key checks
            cursor.execute("SET FOREIGN_KEY_CHECKS = 1;")

            # Commit changes to the database
            connection.commit()
            print(f"Data inserted successfully into the {table_name} table.")

    except Exception as e:
        print(f"An error occurred while inserting data into {table_name}: {e}")
        connection.rollback()  # Rollback in case of error

    finally:
        connection.close()

if __name__ == "__main__":
    # List of CSV files in the desired order
    csv_files = ['User.csv', 'Task.csv', 'Team.csv']

    # Loop through each CSV file and insert its data
    for csv_file in csv_files:
        csv_file_path = f'data/{csv_file}'  # Adjust path as needed
        insert_data_to_table(csv_file_path)
