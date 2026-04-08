with open('resources/views/landing.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace with exact match including any line ending variations
content = content.replace(
    '<div class="product-name">ভ্যারিয়েন্ট {{ $index + 1 }}</div>',
    '<div class="product-name">{{ $prod->name }}</div>'
)

with open('resources/views/landing.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print('Replacement completed')
