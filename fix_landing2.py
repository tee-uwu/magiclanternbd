with open('resources/views/landing.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Simple string replacement for the product name
old_text = '<div class="product-name">ভ্যারিয়েন্ট {{ $index + 1 }}</div>'
new_text = '<div class="product-name">{{ $prod->name }}</div>'

if old_text in content:
    content = content.replace(old_text, new_text)
    print(f"Replaced product name text")
else:
    print(f"Could not find: {repr(old_text)}")
    # Try to find what's actually there
    import re
    matches = re.finditer(r'<div class="product-name">[^<]+</div>', content)
    for match in matches:
        print(f"Found: {repr(match.group())}")

with open('resources/views/landing.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print('File updated')
