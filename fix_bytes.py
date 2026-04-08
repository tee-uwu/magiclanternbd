with open('resources/views/landing.blade.php', 'rb') as f:
    content = f.read()

# Replace the UTF-8 encoded Bengal variant text
old_bytes = b'<div class="product-name">\xe0\xa6\xad\xe0\xa7\x8d\xe0\xa6\xaf\xe0\xa6\xbe\xe0\xa6\xb0\xe0\xa6\xbf\xe0\xa7\x9f\xe0\xa7\x87\xe0\xa6\xa8\xe0\xa7\x8d\xe0\xa6\x9f {{ $index + 1 }}</div>'
new_bytes = b'<div class="product-name">{{ $prod->name }}</div>'

if old_bytes in content:
    content = content.replace(old_bytes, new_bytes)
    with open('resources/views/landing.blade.php', 'wb') as f:
        f.write(content)
    print('Successfully replaced product name')
else:
    print('Could not find the byte sequence')
    # Debug: show what we're looking for
    print(f'Looking for: {repr(old_bytes)}')
