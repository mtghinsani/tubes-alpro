-- Create customer table for storing customer information
CREATE TABLE IF NOT EXISTS `customer_data` (
  `id_customer` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_customer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Add customer_id to transaksi table to link transactions with customers
ALTER TABLE `transaksi` ADD COLUMN `id_customer` int(11) DEFAULT NULL AFTER `username`;
ALTER TABLE `transaksi` ADD COLUMN `nama_customer` varchar(255) DEFAULT NULL AFTER `id_customer`;
ALTER TABLE `transaksi` ADD COLUMN `alamat_customer` text DEFAULT NULL AFTER `nama_customer`;

-- Add foreign key constraint (optional)
-- ALTER TABLE `transaksi` ADD CONSTRAINT `fk_transaksi_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer_data` (`id_customer`) ON DELETE SET NULL;
