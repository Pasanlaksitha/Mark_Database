import mysql.connector
import random

conn = mysql.connector.connect(
    host="",
    user="root",
    password="",
    database="student_mark_db"
)

cursor = conn.cursor()
for i in range(1,100):
    student_id = random.randint(20230000, 20239999)
    week1, week2, week3, week4 = random.randint(0, 100), random.randint(0, 100), random.randint(0, 100), random.randint(0,
                                                                                                                        100)
    print(f"{student_id} - {week1} - {week2} - {week3} - {week4}")
    cursor.execute(
        f"INSERT INTO student (student_id, week1, week2, week3, week4) VALUES ('{student_id}', '{week1}', '{week2}', '{week3}', '{week4}');")

    conn.commit()

cursor.close()
conn.close()
