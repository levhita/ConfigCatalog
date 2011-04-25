#!/bin/bash
cd items
for filename in *.jpg
do
        echo "Processing $filename..."
	convert -thumbnail 200 $filename thumbs/$filename
	convert -thumbnail 600 $filename web/$filename
done
