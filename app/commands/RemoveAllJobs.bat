net stop "Print Spooler"
rmdir /s /q "C:\Windows\System32\spool\PRINTERS\"
net start "Print Spooler"