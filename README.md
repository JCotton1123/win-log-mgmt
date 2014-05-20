Windows Log Mgmt
----------------

A simple central log management solution for windows.

There are better solutions out there but if you don't
feel like paying for something this is an easy way to
build a **central log management box** where you can **process
the logs with your favoriate unix tools**. You can also add
the logs to MySQL if you prefer to build a web app for 
processing them.

## Requirements

* A unix box running newsyslog
* One or more windows servers running the [Snare agent](https://www.intersectalliance.com/our-product/snare-agent/operating-system-agents/snare-agent-for-windows/)
* (Optional) A box running MySQL

## Setup

### Syslog server

Setup a unix box with newsyslog and merge the default newsyslog.conf
with the one supplied in this repo. This configuration contains directives
for logging to a flat file (in a delimited format) and/or logging to MySQL.
The later is cool if you want to build a web app to process the logs.

#### Logging to a flat file

The newsyslog.conf contains a log directive that by default sends the logs
to /var/log/remote/snare.log in a pipe delimited format. This is great if you
want to process the logs using unix tools (grep, cut, awk, etc). This file
will grow and needs to be rotated. A logrotate conf is supplied in this repo.
Customize as a needed.

#### MySQL

This repo includes a schema.sql file that will create the database and tables
referenced in newsyslog.conf. Feel free to customize. You'll likely want to
setup some indexes based on your common search patterns.

Storage will likely become a concern. In my current implementation I have the
table paritioned and I've configured a script to delete logs after the a preset
period of time. The archive script is included in the cron dir. Additionally,
I've provided the script I wrote to manage the table paritions.

### Windows servers

Install [snare](https://www.intersectalliance.com/our-product/snare-agent/operating-system-agents/snare-agent-for-windows/) and configure it to the log to your newsyslog server.

