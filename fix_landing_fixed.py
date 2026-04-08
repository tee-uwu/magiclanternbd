import re

with open('resources/views/landing.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

print("Original product-name lines:")
print(re.findall(r'<div class="product-name">.*?</div>', content, re.DOTALL))

# 1. Fix product name to use $products[$index]->name with fallback
content = re.sub(
    r'<div class="product-name">ভ্যারিয়েন্ট {{ \$index \+ 1 }}</div>',
    '<div class="product-name">{{ $products[$index]->name ?? \'ভ্যারিয়েন্ট \' . ($index + 1) }}</div>',
    content
)

# 2. Fix old price in product loop: $oldPrice -> $products[$index]->old_price ?? $oldPrice
content = re.sub(
    r'(<div class="product-pricing">.*?text-decoration:line-through.*?number_format\(\$oldPrice\))',
    r'\1 ?? $products[$index]->old_price ?? $oldPrice)',
    content,
    flags=re.DOTALL
)

# 3. Fix current price strong tag: $price -> $products[$index]->price ?? $price
content = re.sub(
    r'(product-pricing.*?<strong>৳ {{ number_format\(\$price\))',
    r'\1 ?? $products[$index]->price ?? $price)',
    content,
    flags=re.DOTALL
)

# 4. Fix product thumb img src to dynamic image
content = re.sub(
    r'<img src="{{ \$heroImage }}" alt="{{ \$color }}"',
    '<img src="{{ $products[$index]->image ? asset(\'storage/\' . $products[$index]->image) : $heroImage }}" alt="{{ $products[$index]->name ?? $color }}"',
    content
)

# 5. Update data-product-name to dynamic
content = re.sub(
    r'data-product-name="{{ \$product->name ?? \'Magic Lantern\' }}"',
    'data-product-name="{{ $products[$index]->name ?? \'Magic Lantern\' }}"',
    content
)

# 6. Update data-product-price 
content = re.sub(
    r'data-product-price="{{ \$price }}"',
    'data-product-price="{{ $products[$index]->price ?? $price }}"',
    content
)

print("\nUpdated successfully! Check product cards now use $products[$index] dynamically.")
print("Run this script, then visit your landing page to verify.")

with open('resources/views/landing.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

