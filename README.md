# Doctrine ND

Namų darbai:
Sumodeliuoti duomenų struktūrą pagal duotą pvz:
products:
`id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `category_id` int(11) NOT NULL,
 `active` tinyint(1) NOT NULL,
 PRIMARY KEY (`id`)
categories:
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`)

Products lentelė bei Entity turi turėti sąryšį OneToMany su Categories. Sąryšis turi būti abipusis. (OneToMany/ManyToOne).
Sukurti Kontrolleri kuris turės 2 Action'us:
* Išsaugoti Kategoriją bei Produktą priskiriant teisingą sąryšį.
    * Reikšmės gali būti tos pačios (hardcoded)
    * Panaudoti tik vieną persist. (Kategorija turi būt išsaugota kartu su Produktu Cascade principu.)
* Ištrinti Productą neištrinant Kategorijos.
    * Kuris produktas bus trinamas tai turėtu būti valdoma per URL. (id)
    * Papildomi Taškai jei Entity paimamas Nekviečiant repozitorijos. (URL Mapping)

Migracijos yra privalomos. Negalima naudoti schema:update.
