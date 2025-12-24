import sys
import zipfile
import os

input_path = sys.argv[1]
output_zip = sys.argv[2]

with zipfile.ZipFile(output_zip, 'w', zipfile.ZIP_DEFLATED) as zipf:
    for root, dirs, files in os.walk(input_path):
        for file in files:
            full_path = os.path.join(root, file)
            arcname = os.path.relpath(full_path, input_path)
            zipf.write(full_path, arcname)
