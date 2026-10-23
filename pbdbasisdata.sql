CREATE DATABASE projectPBD;
USE projectPBD;

-- DDL

CREATE TABLE satuan (
	idsatuan INT AUTO_INCREMENT PRIMARY KEY,
    nama_satuan VARCHAR(45) NOT NULL,
    status TINYINT NOT NULL DEFAULT 1
    );
SELECT * FROM satuan;

CREATE TABLE barang (
	idbarang INT AUTO_INCREMENT PRIMARY KEY,
    jenis CHAR(1) NOT NULL,
    nama VARCHAR(45) NOT NULL,
    status TINYINT NOT NULL DEFAULT 1,
    harga INT NOT NULL
    );
SELECT * FROM barang;

CREATE TABLE vendor (
	idvendor INT AUTO_INCREMENT PRIMARY KEY,
    nama_vendor VARCHAR(100) NOT NULL,
    badan_hukum CHAR(1) NOT NULL,
    status CHAR(1) NOT NULL
    );
SELECT * FROM vendor;

CREATE TABLE `user` (
	iduser INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(45) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL
    );
SELECT * FROM `user`;

CREATE TABLE role (
	idrole INT AUTO_INCREMENT PRIMARY KEY,
    nama_role VARCHAR(100) NOT NULL
    );
SELECT * FROM role;

CREATE TABLE margin_penjualan (
	idmargin_penjualan INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    persen DOUBLE NOT NULL,
    status TINYINT NOT NULL DEFAULT 1,
    updated_at TIMESTAMP NOT NULL DEFAULT NOW()
    );
SELECT * FROM margin_penjualan;

CREATE TABLE kartu_stok (
	idkartu_stok BIGINT AUTO_INCREMENT PRIMARY KEY,
    jenis_transaksi CHAR(1) NOT NULL,
    masuk INT NOT NULL DEFAULT 0,
    keluar INT NOT NULL DEFAULT 0,
    stock INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    idtransaksi INT NOT NULL
    );
SELECT * FROM kartu_stok;

CREATE TABLE penerimaan (
	idpenerimaan BIGINT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    status CHAR(1) NOT NULL
    );
SELECT * FROM penerimaan;

CREATE TABLE detail_penerimaan (
	iddetail_penerimaan BIGINT AUTO_INCREMENT PRIMARY KEY,
    jumlah_terima INT NOT NULL,
    harga_satuan_terima INT NOT NULL,
    sub_total_terima INT NOT NULL
    );
SELECT * FROM detail_penerimaan;

CREATE TABLE pengadaan (
	idpengadaan BIGINT AUTO_INCREMENT PRIMARY KEY,
    timestamp TIMESTAMP NOT NULL DEFAULT NOW(),
    status CHAR(1) NOT NULL,
    subtotal_nilai INT NOT NULL,
    ppn INT NOT NULL,
    total_nilai INT NOT NULL
    );
SELECT * FROM pengadaan;

CREATE TABLE detail_pengadaan (
	iddetail_pengadaan BIGINT AUTO_INCREMENT PRIMARY KEY,
    harga_satuan INT NOT NULL,
    jumlah INT NOT NULL,
    sub_total INT NOT NULL
    );
SELECT * FROM detail_pengadaan;

CREATE TABLE penjualan (
	idpenjualan INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP NOT NULL DEFAULT NOW(),
    subtotal_nilai INT NOT NULL,
    ppn INT NOT NULL,
    total_nilai INT NOT NULL
	);
SELECT * FROM penjualan;

CREATE TABLE detail_penjualan (
	iddetail_penjualan BIGINT AUTO_INCREMENT PRIMARY KEY,
    harga_satuan INT NOT NULL,
    jumlah INT NOT NULL,
    subtotal INT NOT NULL
    );
SELECT * FROM detail_penjualan;

CREATE TABLE `retur` (
	idretur BIGINT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP NOT NULL DEFAULT NOW()
    );
SELECT * FROM `retur`;

CREATE TABLE detail_retur (
	iddetail_retur INT AUTO_INCREMENT PRIMARY KEY,
    jumlah INT NOT NULL,
    alasan VARCHAR(200) NOT NULL
    );
SELECT * FROM detail_retur;

ALTER TABLE barang
	ADD idsatuan INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idsatuan) REFERENCES satuan(idsatuan)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `user`
	ADD idrole INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idrole) REFERENCES role(idrole)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE margin_penjualan
	ADD iduser INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (iduser) REFERENCES `user`(iduser)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE kartu_stok
	ADD idbarang INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idbarang) REFERENCES barang(idbarang)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE penerimaan
	ADD idpengadaan BIGINT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idpengadaan) REFERENCES pengadaan(idpengadaan)
	ON DELETE CASCADE ON UPDATE CASCADE,
	ADD iduser INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (iduser) REFERENCES `user`(iduser)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE detail_penerimaan
	ADD idpenerimaan BIGINT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idpenerimaan) REFERENCES penerimaan(idpenerimaan)
	ON DELETE CASCADE ON UPDATE CASCADE,
	ADD barang_idbarang INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (barang_idbarang) REFERENCES barang(idbarang)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE pengadaan
	ADD user_iduser INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (user_iduser) REFERENCES `user`(iduser)
	ON DELETE CASCADE ON UPDATE CASCADE,
	ADD vendor_idvendor INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (vendor_idvendor) REFERENCES vendor(idvendor)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE detail_pengadaan
	ADD idbarang INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idbarang) REFERENCES barang(idbarang)
	ON DELETE CASCADE ON UPDATE CASCADE,
	ADD idpengadaan BIGINT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idpengadaan) REFERENCES pengadaan(idpengadaan)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE penjualan
	ADD iduser INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (iduser) REFERENCES `user`(iduser)
	ON DELETE CASCADE ON UPDATE CASCADE,
	ADD idmargin_penjualan INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idmargin_penjualan) REFERENCES margin_penjualan(idmargin_penjualan)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE detail_penjualan
	ADD penjualan_idpenjualan INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (penjualan_idpenjualan) REFERENCES penjualan(idpenjualan)
	ON DELETE CASCADE ON UPDATE CASCADE,
	ADD idbarang INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idbarang) REFERENCES barang(idbarang)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `retur`
	ADD idpenerimaan BIGINT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idpenerimaan) REFERENCES penerimaan(idpenerimaan)
	ON DELETE CASCADE ON UPDATE CASCADE,
	ADD iduser INT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (iduser) REFERENCES `user`(iduser)
	ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE detail_retur
	ADD idretur BIGINT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (idretur) REFERENCES `retur`(idretur)
	ON DELETE CASCADE ON UPDATE CASCADE,
	ADD iddetail_penerimaan BIGINT NOT NULL,
	ADD CONSTRAINT FOREIGN KEY (iddetail_penerimaan) REFERENCES detail_penerimaan(iddetail_penerimaan)
	ON DELETE CASCADE ON UPDATE CASCADE;

	-- DML

	INSERT INTO satuan(nama_satuan, status) VALUES
	("Pcs", 1), ("Box", 1), ("Pack", 1), ("Set", 1), ("Unit", 1);

	INSERT INTO barang(jenis, nama, status, harga, idsatuan) VALUES
	("N", "Nuigurumi Koarais", 1, 500000, 1), ("S", "Acrylic Stand Kitsurii", 1, 250000, 1), ("K", "Acrylic Keychain Usashine", 1, 150000, 1), ("B", "Can Badges Kitsurii", 1, 60000, 1), ("C", "Cheki Koarais", 1, 60000, 3);

	INSERT INTO vendor(nama_vendor, badan_hukum, status) VALUES
	("Pekalongan", "Y", "A"), ("CetakPacar", "N", "A"), ("GADOGADO", "Y", "A"), ("Dollpro", "Y", "A"), ("SurgaVNYL", "Y", "N");

	INSERT INTO role(nama_role) VALUES
	("Admin"), ("Manager"), ("Kasir"), ("Staf Pengadaan"), ("Staf Gudang");

	INSERT INTO `user`(username, password, idrole) VALUES
	("SabitKuasa", "sabit123", 1), ("Mitya123", "MityaVodya", 2), ("NagaPerak", "momongarules", 3), ("kulisawit", "antekantekamerika", 4), ("IkeJoshi","dirgahayu1", 5);
	-- admin, manager sekaligus penghitung

	INSERT INTO margin_penjualan(persen, status, iduser) VALUES
	(10.0, 1, 1), (15.0, 1, 1), (20.0, 1, 2), (25.0, 1, 1), (30.0, 0, 2);
