#!/bin/bash

##
# By Aslam
# aslam@bpract.com
#
# See README or code below for usage
##

# Is this really necessary?
if [ $(id -u) != 0 ]; then
printf "This script must be run as root.\n"
  exit 1
fi

# Script arguments
laravel_path=${1%/}
laravel_user=${2}
httpd_group="${3:-www-data}"

# Help menu
print_help() {
cat <<-HELP

This script is used to fix permissions of a Laravel installation
you need to provide the following arguments:

1) Path to your Laravel installation.
2) Username of the user that you want to give files/directories ownership.
3) HTTPD group name (defaults to www-data for Apache).

Usage: (sudo) bash ${0##*/} --laravel_path=PATH --laravel_user=USER --httpd_group=GROUP

Example: (sudo) bash ${0##*/} --laravel_path=/var/www/html --laravel_user=cloud --httpd_group=www-data

HELP
exit 0
}

# Parse Command Line Arguments
while [ $# -gt 0 ]; do
case "$1" in
    --laravel_path=*)
      laravel_path="${1#*=}"
      ;;
    --laravel_user=*)
      laravel_user="${1#*=}"
      ;;
    --httpd_group=*)
      httpd_group="${1#*=}"
      ;;
    --help) print_help;;
    *)
      printf "Invalid argument, run --help for valid arguments.\n";
      exit 1
  esac
shift
done

# Basic check to see if this is a valid Drupal install
if [ -z "${laravel_path}" ] || [ ! -d "${laravel_path}/bootstrap" ] || [ ! -f "${laravel_path}/.env" ]; then
printf "Please provide a valid Laravel path.\n"
printf "(Or maybe you forgot to copy .env file or /bootstrap folder ;) ).\n"
  print_help
  exit 1
fi

# Basic check to see if valiud user
if [ -z "${laravel_user}" ] || [ $(id -un ${laravel_user} 2> /dev/null) != "${laravel_user}" ]; then
printf "Please provide a valid user.\n"
  print_help
  exit 1
fi

# Start changing permissions
cd $laravel_path
printf "Changing ownership of all contents of \"${laravel_path}\":\n user => \"${laravel_user}\" \t group => \"${httpd_group}\"\n"
chown -R ${laravel_user}:${httpd_group} .

printf "Changing permissions of all directories inside \"${laravel_path}\" to \"rwxr-x---\" except storage with subfolders and bootstrap cache folder and except .git folders ... \n"
#find . -type d -exec chmod u=rwx,g=rx,o= '{}' \+

find . -type d -not -path "./storage" -not -path "./storage/*" -not -path "./bootstrap/cache" -not -name ".git" -exec chmod u=rwx,g=rx,o= '{}' \+

printf "Changing permissions of all files inside \"${laravel_path}\" to \"rw-r-----\" except .env and bootstrap cache folder and except name .gitignore...\n"
#find . -type f -exec chmod u=rw,g=r,o= '{}' \+
find . -type f -not -path "./.env" -not -path "./storage/*" -not -name ".gitignore" -exec chmod u=rw,g=r,o=r '{}' \+


printf "Changing permissions of \"storage\" directory in \"${laravel_path}/storage\" to \"rwxrwx---\"...\n"
cd ${laravel_path}/storage
find . -type d -exec chmod ug=rwx,o= '{}' \+


printf "Changing permissions of all files inside \"storage\" directories in \"${laravel_path}\" to \"rw-rw----\"...\n"
printf "Changing permissions of all directories inside \"storage\" directory in \"${laravel_path}\" to \"rwxrwx---\"...\n"
# for x in ./*/storage; do
# printf "Changing permissions ${x} ...\n"
#   find ${x} -type d -not -name ".git" -exec chmod ug=rwx,o= '{}' \+
#   find ${x} -type f -not -path "./*/storage/.htaccess" -exec chmod ug=rw,o= '{}' \+
# done

# printf "Changing permissions of .htaccess files inside \"storage\" directory in \"${laravel_path}\" to \"rw-r----\"...\n"
# for x in ./*/storage/.htaccess; do
# printf "Changing permissions ${x} ...\n"
#   find ${x} -type f -exec chmod u=rw,g=r,o= '{}' \+
# done

# printf "Changing permissions of \".git\" directories and files in \"${laravel_path}\" to \"rwx------\"...\n"
# cd ${laravel_path}
# chmod -R u=rwx,go= .git
# chmod u=rwx,go= .gitignore

printf "Changing permissions of various Laravel text files in \"${laravel_path}\" to \"rwx------\"...\n"
cd ${laravel_path}
chmod u=rwx,go= package.json readme.md composer.json




printf "Enable executing node_modules in \"${laravel_path}\" to \"rwx------\" (Which is necessary for running npm run as the current user.)...\n"
cd ${laravel_path}
chmod -R a+x node_modules


printf "Giving the newly created files/directories the group of the parent directory - \"${laravel_path}\"...\n"
cd ${laravel_path}
find ./bootstrap/cache -type d -exec chmod g+s {} \;
find ./storage -type d -exec chmod g+s {} \;



printf "Letting newly created files/directories inherit the default owner  - \"${laravel_path}\"...\n"
## permissions up to maximum permission of rwx e.g. new files get 664, 
## folders get 775
cd ${laravel_path}
setfacl -R -d -m g::rwx storage;
setfacl -R -d -m g::rwx bootstrap/cache;

printf "Enable executing node_modules in \"${laravel_path}\" to \"rwx------\"...\n"
cd ${laravel_path}
chmod -R a+x node_modules

# chmod 755 .htaccess


echo "Done setting proper permissions on files and directories"