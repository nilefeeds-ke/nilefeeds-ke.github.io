#!/bin/bash
git add .
read message branch

git commit -m $message
git push -u origin $branch