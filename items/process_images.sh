#!/bin/bash
FILES="$@"
for i in $FILES
do
echo "Processing image $i ..."
convert -thumbnail 200 $i thumbs/$i
convert -thumbnail 600 $i web/$i
done
