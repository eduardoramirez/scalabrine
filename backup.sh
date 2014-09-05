#!/bin/bash

# Path to backup directories
DIRS="/var/www/html/ /etc"
 
# Store todays date
NOW=$(date +"%F")
 
# Store backup path
BACKUP="/backup/$NOW"
 
# Backup file name hostname.time.tar.gz 
BFILE="$(hostname).$(date +'%T').tar.gz"
MFILE="$(hostname).$(date +'%T').mysql.sq.gz"

 
# Set MySQL username and password
MYSQLUSER="root"
MYSQLPASSWORD="Tw0sof+9Ly"
 
# Location to store backup
DUMPDIR="/backup/"

# Paths for binary files
TAR="/bin/tar"
MYSQLDUMP="/usr/bin/mysqldump"
GZIP="/bin/gzip"
SCP="/usr/bin/scp"
SSH="/usr/bin/ssh"
LOGGER="/usr/bin/logger"
 
# make sure backup directory exists
[ ! -d $BACKUP ] && mkdir -p ${BACKUP}
 
# Log backup start time in /var/log/messages
$LOGGER "$0: *** Backup started @ $(date) ***"
 
# Backup websever dirs
$TAR -zcvf ${BACKUP}/${BFILE} "${DIRS}"

# Backup MySQL
$MYSQLDUMP  -u ${MYSQLUSER} -h localhost -p${MYSQLPASSWORD} --all-databases | $GZIP -9 > ${BACKUP}/${MFILE}
 
# Copy things to directory saved
$cp -r ${BACKUP}/* ${DUMPDIR}/${NOW} 

# Log backup end time in /var/log/messages
$LOGGER "$0: *** Backup Ended @ $(date) ***"


