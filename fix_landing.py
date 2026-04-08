import re

with open('resources/views/landing.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace the product name line
content = re.sub(
    r'<div class="product-name">ভ্যারিয়েন্ট {{ \$index \+ 1 }}</div>',
    '<div class="product-name">{{ $prod->name }}</div>',
    content
)

# Replace $oldPrice with $prod->old_price in the product loop
# This line is: <div style="text-decoration:line-through; color:#9a948c;">৳ {{ number_format($oldPrice) }}</div>
content = re.sub(
    r'number_format\(\$oldPrice\)',
    'number_format($prod->old_price)',
    content
)

# Replace $price with $prod->price - but ONLY in the product card loops (not the main hero section)
# We need to be careful - there's only one place where $price is used in product-pricing within the loop
# Actually, let me search for the specific context: Strong tag within product-pricing div after product-name
lines = content.split('\n')
new_lines = []
in_product_loop = False
loop_depth = 0

for i, line in enumerate(lines):
    # Track when we enter the forelse loop
    if '@forelse($products as $prod)' in line:
        in_product_loop = True
        loop_depth = 1
    elif '@endforelse' in line and in_product_loop:
        in_product_loop = False
        loop_depth = 0
    
    # Within the product loop, fix the price
    if in_product_loop and 'number_format($price)' in line and '<strong>' in line:
        line = line.replace('number_format($price)', 'number_format($prod->price)')
    
    new_lines.append(line)

content = '\n'.join(new_lines)

with open('resources/views/landing.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)

print('File updated successfully')
