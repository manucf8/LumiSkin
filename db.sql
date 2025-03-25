use lumiskin;

INSERT INTO products (name, description, image, brand, price, created_at, updated_at) VALUES
('Hydrating Facial Cleanser', 'Gentle cleanser that removes dirt, oil, and makeup without disrupting the skin’s natural barrier.', '1.jpeg', 'CeraVe', 12, NOW(), NOW()),
('Vitamin C Serum', 'Brightens skin tone and reduces the appearance of dark spots.', '2.jpeg', 'TruSkin', 18, NOW(), NOW()),
('Niacinamide 10% + Zinc 1%', 'Helps reduce the appearance of skin blemishes and congestion.', '3.jpeg', 'The Ordinary', 15, NOW(), NOW()),
('Sunscreen SPF 50+', 'Lightweight, broad spectrum SPF protection ideal for daily use.', '4.jpeg', 'La Roche-Posay', 24, NOW(), NOW()),
('Moisturizing Cream', 'Intensely hydrating cream for dry to very dry skin.', '5.jpeg', 'CeraVe', 14, NOW(), NOW()),
('Gentle Exfoliating Scrub', 'Buffs away dead skin cells to reveal smoother skin.', '6.jpeg', 'Aveeno', 9, NOW(), NOW()),
('Micellar Cleansing Water', 'Removes makeup and cleanses skin in one step.', '7.jpeg', 'Garnier', 10, NOW(), NOW()),
('Facial Toner with Witch Hazel', 'Alcohol-free toner that helps tighten pores and refresh skin.', '8.jpeg', 'Thayers', 11, NOW(), NOW()),
('Retinol Night Cream', 'Reduces fine lines and wrinkles while improving skin texture.', '9.jpeg', 'Neutrogena', 25, NOW(), NOW()),
('Deep Clean Clay Mask', 'Purifies and detoxifies pores with natural clay.', '10.jpeg', 'L\'Oréal Paris', 13, NOW(), NOW()),
('Tinted Moisturizer SPF 30', 'Light coverage with hydration and sun protection.', '11.jpeg', 'bareMinerals', 27, NOW(), NOW()),
('Longwear Foundation', 'Full-coverage foundation with a matte finish.', '12.jpeg', 'Maybelline', 19, NOW(), NOW()),
('Lip Gloss Set', 'Hydrating lip gloss with a high-shine finish.', '13.jpeg', 'NYX', 11, NOW(), NOW()),
('Liquid Eyeliner Pen', 'Smudge-proof liquid eyeliner for sharp lines.', '14.jpeg', 'e.l.f.', 8, NOW(), NOW()),
('Mascara Volume Boost', 'Adds volume and length without clumping.', '15.jpeg', 'L\'Oréal Paris', 12, NOW(), NOW()),
('Blush Palette', 'Blush palette with 4 natural shades for every skin tone.', '16.jpeg', 'Milani', 13, NOW(), NOW()),
('Makeup Setting Spray', 'Locks makeup in place for up to 16 hours.', '17.jpeg', 'Urban Decay', 29, NOW(), NOW()),
('Hydrating Lip Balm', 'Moisturizes dry lips with shea butter and coconut oil.', '18.jpeg', 'Burt\'s Bees', 5, NOW(), NOW()),
('Facial Sheet Mask', 'Single-use mask infused with aloe vera for instant hydration.', '19.jpeg', 'TONYMOLY', 4, NOW(), NOW()),
('Under Eye Cream', 'Targets puffiness and dark circles with caffeine.', '20.jpeg', 'The Inkey List', 14, NOW(), NOW());

INSERT INTO categories (name, description, created_at, updated_at) VALUES
('Cleansers', 'Gentle products to remove dirt, oil, and makeup from the skin.', NOW(), NOW()),
('Moisturizers', 'Creams and lotions that hydrate and protect the skin.', NOW(), NOW()),
('Serums & Treatments', 'Concentrated formulas to target specific skin concerns.', NOW(), NOW()),
('Sun Protection', 'Sunscreens and SPF-enhanced products for daily protection.', NOW(), NOW()),
('Face Makeup', 'Foundations, concealers, and powders for a flawless base.', NOW(), NOW()),
('Eye Makeup', 'Products for lashes, brows, and eyelids including mascaras and shadows.', NOW(), NOW()),
('Lip Care & Color', 'Balms, glosses, and lipsticks to hydrate and beautify lips.', NOW(), NOW()),
('Masks & Exfoliators', 'Deep cleansing and skin renewal treatments.', NOW(), NOW());

INSERT INTO category_product (category_id, product_id, created_at, updated_at) VALUES
(1, 1, NOW(), NOW()),  -- Hydrating Facial Cleanser → Cleansers
(2, 5, NOW(), NOW()),  -- Moisturizing Cream → Moisturizers
(3, 2, NOW(), NOW()),  -- Vitamin C Serum → Serums & Treatments
(3, 3, NOW(), NOW()),  -- Niacinamide → Serums & Treatments
(4, 4, NOW(), NOW()),  -- Sunscreen → Sun Protection
(1, 6, NOW(), NOW()),  -- Exfoliating Scrub → Cleansers
(1, 7, NOW(), NOW()),  -- Micellar Water → Cleansers
(3, 9, NOW(), NOW()),  -- Retinol Night Cream → Serums & Treatments
(8, 10, NOW(), NOW()), -- Clay Mask → Masks & Exfoliators
(5, 11, NOW(), NOW()), -- Tinted Moisturizer → Face Makeup
(5, 12, NOW(), NOW()), -- Foundation → Face Makeup
(7, 13, NOW(), NOW()), -- Lip Gloss → Lip Care & Color
(6, 14, NOW(), NOW()), -- Eyeliner → Eye Makeup
(6, 15, NOW(), NOW()), -- Mascara → Eye Makeup
(5, 16, NOW(), NOW()), -- Blush Palette → Face Makeup
(5, 17, NOW(), NOW()), -- Setting Spray → Face Makeup
(7, 18, NOW(), NOW()), -- Lip Balm → Lip Care & Color
(8, 19, NOW(), NOW()), -- Sheet Mask → Masks & Exfoliators
(3, 20, NOW(), NOW()), -- Under Eye Cream → Serums & Treatments
(2, 20, NOW(), NOW()); -- Under Eye Cream → Moisturizers
