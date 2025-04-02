#!/bin/sh

# Set file permissions to 644
find . -type f -exec chmod 644 {} \;

# Set directory permissions to 755
find . -type d -exec chmod 755 {} \;
