Cassandra: 
Start:
source ~/.bashrc

Run:
sudo docker exec -it some-cassandra bash
cqlsh
--------------------------------------------------------------

Neo4j:
sami1234
--------------------------------------------------------------

Hive:
Start:
sudo docker run -d -p 10000:10000 -p 10002:10002 --env SERVICE_NAME=hiveserver2 --name hive4 apache/hive:4.0.0

Run:
sudo docker exec -it hive4 beeline -u 'jdbc:hive2://localhost:10000/'
-------------------------------------------------------------

Oracle:
sudo docker exec -it oracle-xe sqlplus sys/ash@//localhost:1521/XE as sysdba