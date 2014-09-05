#!/bin/bash

# Path to backup directories
DIR1="/var/www/html/"
DIR2="/etc"
 
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

# Paths for binary files
TAR="/bin/tar"
MYSQLDUMP="/usr/bin/mysqldump"
GZIP="/bin/gzip"
SCP="/usr/bin/scp"
LOGGER="/usr/bin/logger"
 
# make sure backup directory exists
[ ! -d $BACKUP ] && mkdir -p ${BACKUP}
 
# Log backup start time in /var/log/messages
$LOGGER "$0: *** Backup started @ $(date) ***"
 
# Backup websever dirs
$TAR -zcvf ${BACKUP}/${BFILE} ${DIR1}
$TAR -zcvf ${BACKUP}/${BFILE} ${DIR2}

# Backup MySQL
$MYSQLDUMP  -u ${MYSQLUSER} -h localhost -p${MYSQLPASSWORD} --all-databases | $GZIP -9 > ${BACKUP}/${MFILE}
 
# Log backup end time in /var/log/messages
$LOGGER "$0: *** Backup Ended @ $(date) ***"


