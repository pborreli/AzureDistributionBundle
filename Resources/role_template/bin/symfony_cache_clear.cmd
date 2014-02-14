@echo off
cd "%~dp0"

ECHO Starting Symfony cache initialization... >> ..\startup-tasks-log.txt

"D:\Program Files (x86)\PHP\v5.3\php.exe" ..\app\console cache:clear --env=azure >> ..\startup-tasks-log.txt 2>>..\startup-tasks-error-log.txt

ECHO Symfony Cache warmed up >> ..\startup-tasks-log.txt

