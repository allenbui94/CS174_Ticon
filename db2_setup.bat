cd %~dp0
db2 "drop database SAMPLE"
db2 "create database SAMPLE"
db2 "connect to SAMPLE"
db2 "create bufferpool bp8k pagesize 8 k"
db2 "create system temporary tablespace tmpsys8k pagesize 8 k bufferpool bp8k"
db2se enable_db SAMPLE
db2 -tvmf "sql\init.sql"
db2 -tvmf "sql\insert_statements.sql"
echo Finished