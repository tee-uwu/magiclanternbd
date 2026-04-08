with open('resources/views/landing.blade.php', 'rb') as f:
    content_bytes = f.read()

# Look for the bytes around line 1767
import re
# Find all occurrences of the product-name div
pattern = b'product-name'
matches = list(re.finditer(pattern, content_bytes))
print(f"Found {len(matches)} matches for 'product-name'")

# Print around the 4th match (which should be in the forelse loop based on earlier searches)
if len(matches) > 3:
    pos = matches[3].start()
    # Show 200 bytes around it
    start = max(0, pos - 100)
    end = min(len(content_bytes), pos + 200)
    chunk = content_bytes[start:end]
    print(f"\nBytes around position {pos}:")
    print(repr(chunk))
    
    # Try to decode and see what's there
    print(f"\nDecoded:")
    print(chunk.decode('utf-8', errors='replace'))
