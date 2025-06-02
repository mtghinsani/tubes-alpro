-- Add category column to menu table
ALTER TABLE `menu` ADD COLUMN `category` VARCHAR(50) DEFAULT NULL AFTER `nama`;

-- Update existing menu items with categories
UPDATE `menu` SET `category` = 'coffee' WHERE `nama` LIKE '%americano%' OR `nama` LIKE '%coffee%' OR `nama` LIKE '%kopi%';
UPDATE `menu` SET `category` = 'coffee' WHERE `nama` LIKE '%kapal api%';

-- Insert sample menu items with categories if needed
INSERT INTO `menu` (`nama`, `category`, `harga`, `gambar`, `stok`) VALUES
('Cappuccino', 'coffee', 25000, '', 15),
('Latte', 'coffee', 28000, '', 12),
('Espresso', 'coffee', 18000, '', 20),
('Green Tea', 'tea', 15000, '', 25),
('Earl Grey', 'tea', 16000, '', 18),
('Jasmine Tea', 'tea', 14000, '', 22),
('Chocolate Croissant', 'snacks', 12000, '', 10),
('Blueberry Muffin', 'snacks', 15000, '', 8),
('Sandwich Club', 'snacks', 35000, '', 6),
('Tiramisu', 'desserts', 32000, '', 5),
('Cheesecake', 'desserts', 28000, '', 7),
('Chocolate Cake', 'desserts', 25000, '', 9);
