#!/bin/bash
git add .
read message
read branch
git commit -m $message
git push -u origin $branch