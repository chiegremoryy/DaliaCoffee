<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;
use App\Models\Category;

class ImportMenuPdfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Matikan pengecekan foreign key & hapus data lama
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('menu_ingredients')->truncate();
        DB::table('menus')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Buat atau update kategori
        $categoriesData = [
            1 => 'Makanan',
            2 => 'Minuman',
            3 => 'Snack',
            5 => 'Milkshake',
            6 => 'Coffee',
            7 => 'Jus and Mix',
            9 => 'Minuman Spesial',
            10 => 'Seafood Bakar',
            11 => 'New Snack',
            12 => 'Mocktail',
        ];

        foreach ($categoriesData as $id => $name) {
            Category::updateOrCreate(['id' => $id], ['name' => $name]);
        }

        // 3. Masukkan data menu dari PDF
        $menusData = [
            // Makanan (ID 1)
            ['category_id' => 1, 'name' => 'Nasi Goreng Telur', 'price' => 12000, 'description' => 'Nasi goreng lezat dengan bumbu khas dan telur'],
            ['category_id' => 1, 'name' => 'Nasi Goreng Sosis', 'price' => 13000, 'description' => 'Nasi goreng lezat dengan campuran sosis premium'],
            ['category_id' => 1, 'name' => 'Nasi Goreng Bakso', 'price' => 13000, 'description' => 'Nasi goreng lezat dengan irisan bakso sapi'],
            ['category_id' => 1, 'name' => 'Mie Goreng', 'price' => 10000, 'description' => 'Mie goreng bumbu tradisional khas Kedai Dalia'],
            ['category_id' => 1, 'name' => 'Mie Kuah', 'price' => 10000, 'description' => 'Mie rebus berkuah hangat dengan sayuran segar'],
            ['category_id' => 1, 'name' => 'Mie Goreng Telur', 'price' => 12000, 'description' => 'Mie goreng nikmat disajikan dengan telur dadar/ceplok'],
            ['category_id' => 1, 'name' => 'Mie Kuah Telur', 'price' => 12000, 'description' => 'Mie kuah hangat disajikan dengan telur dadar/ceplok'],
            ['category_id' => 1, 'name' => 'Kwetiau Goreng', 'price' => 12000, 'description' => 'Kwetiau goreng gurih khas Kedai Dalia'],
            ['category_id' => 1, 'name' => 'Kwetiau Kuah', 'price' => 12000, 'description' => 'Kwetiau kuah hangat dengan bumbu gurih'],
            ['category_id' => 1, 'name' => 'Capcay Goreng', 'price' => 15000, 'description' => 'Tumisan aneka sayuran segar dan bakso dengan sedikit kuah kental'],
            ['category_id' => 1, 'name' => 'Capcay Kuah', 'price' => 15000, 'description' => 'Sayuran capcay berkuah hangat gurih segar'],

            // Minuman (ID 2)
            ['category_id' => 2, 'name' => 'Es Teh / Panas', 'price' => 3000, 'description' => 'Teh manis segar pilihan, disajikan dingin atau hangat'],
            ['category_id' => 2, 'name' => 'Es Jeruk / Panas', 'price' => 6000, 'description' => 'Perasan jeruk segar asli, disajikan dingin atau hangat'],
            ['category_id' => 2, 'name' => 'Es Lemon Tea / Panas', 'price' => 7000, 'description' => 'Perpaduan teh manis dengan perasan jeruk lemon segar'],
            ['category_id' => 2, 'name' => 'Es Sirup', 'price' => 3000, 'description' => 'Minuman sirup manis segar dingin'],
            ['category_id' => 2, 'name' => 'Es Susu / Panas', 'price' => 6000, 'description' => 'Minuman susu kental manis hangat atau dengan es batu'],
            ['category_id' => 2, 'name' => 'Es Susu Tape / Panas', 'price' => 7000, 'description' => 'Perpaduan susu kental manis dengan tape ketan pilihan'],
            ['category_id' => 2, 'name' => 'Wedang Jahe', 'price' => 6000, 'description' => 'Minuman tradisional jahe hangat berkhasiat'],
            ['category_id' => 2, 'name' => 'Wedang Susu Jahe', 'price' => 7000, 'description' => 'Minuman susu hangat berpadu dengan jahe geprek'],
            ['category_id' => 2, 'name' => 'Es Soda Gembira', 'price' => 10000, 'description' => 'Campuran sirup, susu kental manis, soda Fanta putih, dan es'],
            ['category_id' => 2, 'name' => 'Es Kopi Susu', 'price' => 7000, 'description' => 'Kopi hitam berpadu susu manis segar disajikan dengan es'],
            ['category_id' => 2, 'name' => 'Es White Coffee', 'price' => 7000, 'description' => 'White coffee instan disajikan dingin'],
            ['category_id' => 2, 'name' => 'Es Coffeemix', 'price' => 7000, 'description' => 'Kopi Coffeemix instan disajikan dingin dengan es'],
            ['category_id' => 2, 'name' => 'Es Good Day Cappucino', 'price' => 7000, 'description' => 'Kopi Good Day Cappucino disajikan dingin dengan es'],

            // Coffee (ID 6)
            ['category_id' => 6, 'name' => 'Kopi Robusta', 'price' => 6000, 'description' => 'Seduhan biji kopi Robusta khas pilihan'],
            ['category_id' => 6, 'name' => 'Kopi Robusta Wine', 'price' => 8000, 'description' => 'Seduhan biji kopi robusta berfermentasi aroma wine unik'],
            ['category_id' => 6, 'name' => 'Kopi Kothok', 'price' => 7000, 'description' => 'Seduhan kopi hitam tradisional direbus bersama gula'],
            ['category_id' => 6, 'name' => 'Kopi Lelet', 'price' => 6000, 'description' => 'Kopi robusta dengan ampas super halus khas Rembang'],
            ['category_id' => 6, 'name' => 'Kopi Tubruk', 'price' => 6000, 'description' => 'Seduhan kopi hitam tubruk klasik aroma mantap'],
            ['category_id' => 6, 'name' => 'Kopi Lasem', 'price' => 6000, 'description' => 'Kopi lelet khas Lasem bercitarasa kuat'],
            ['category_id' => 6, 'name' => 'Good Day Cappucino', 'price' => 6000, 'description' => 'Kopi cappucino instan hangat lengkap dengan choco granule'],
            ['category_id' => 6, 'name' => 'White Coffee', 'price' => 6000, 'description' => 'Kopi luwak white coffee hangat nikmat'],
            ['category_id' => 6, 'name' => 'Coffeemix', 'price' => 6000, 'description' => 'Kopi instan Coffeemix 3-in-1 hangat'],
            ['category_id' => 6, 'name' => 'Kopi Susu', 'price' => 6000, 'description' => 'Seduhan kopi hitam berpadu susu kental manis hangat'],
            ['category_id' => 6, 'name' => 'Kopi Jahe', 'price' => 6000, 'description' => 'Seduhan kopi hitam berpadu jahe bakar hangat'],
            ['category_id' => 6, 'name' => 'Kopi Jahe Susu', 'price' => 7000, 'description' => 'Kopi hitam jahe dengan tambahan susu manis hangat'],

            // Jus and Mix (ID 7)
            ['category_id' => 7, 'name' => 'Jus Alpukat', 'price' => 15000, 'description' => 'Jus alpukat mentega segar dengan kental manis cokelat'],
            ['category_id' => 7, 'name' => 'Jus Strawberry', 'price' => 10000, 'description' => 'Jus strawberry asam manis menyegarkan kaya vitamin C'],
            ['category_id' => 7, 'name' => 'Jus Buah Naga', 'price' => 8000, 'description' => 'Jus buah naga merah segar bernutrisi tinggi'],
            ['category_id' => 7, 'name' => 'Jus Mangga', 'price' => 8000, 'description' => 'Jus buah mangga harum manis matang'],
            ['category_id' => 7, 'name' => 'Jus Nanas', 'price' => 7000, 'description' => 'Jus nanas madu segar rasa asam manis'],
            ['category_id' => 7, 'name' => 'Jus Melon', 'price' => 7000, 'description' => 'Jus buah melon segar manis kaya air'],
            ['category_id' => 7, 'name' => 'Jus Jambu', 'price' => 7000, 'description' => 'Jus jambu biji merah segar kaya serat'],
            ['category_id' => 7, 'name' => 'Jus Wortel', 'price' => 7000, 'description' => 'Jus wortel segar sehat kaya vitamin A'],
            ['category_id' => 7, 'name' => 'Jus Tomat', 'price' => 7000, 'description' => 'Jus tomat segar sehat bernutrisi tinggi'],
            ['category_id' => 7, 'name' => 'Jus Apel', 'price' => 9000, 'description' => 'Jus apel merah manis menyegarkan'],
            ['category_id' => 7, 'name' => 'Wortel Tomat', 'price' => 8000, 'description' => 'Jus mix wortel dan tomat segar berkhasiat'],
            ['category_id' => 7, 'name' => 'Wortel Apel', 'price' => 9000, 'description' => 'Jus kombinasi sehat wortel dan buah apel'],
            ['category_id' => 7, 'name' => 'Wortel Jeruk', 'price' => 8000, 'description' => 'Jus mix wortel segar dengan perasan jeruk manis asli'],
            ['category_id' => 7, 'name' => 'Wortel Pir', 'price' => 8000, 'description' => 'Jus mix wortel dan buah pir segar'],
            ['category_id' => 7, 'name' => 'Jambu Apel', 'price' => 10000, 'description' => 'Jus mix jambu merah dengan buah apel segar'],
            ['category_id' => 7, 'name' => 'Buah Naga Apel', 'price' => 11000, 'description' => 'Jus mix buah naga merah dan apel manis segar'],
            ['category_id' => 7, 'name' => 'Apel Jeruk', 'price' => 10000, 'description' => 'Jus mix buah apel dengan perasan jeruk manis asli'],
            ['category_id' => 7, 'name' => 'Wortel Jeruk Tomat', 'price' => 10000, 'description' => 'Jus mix sehat kombinasi wortel, jeruk, dan tomat'],
            ['category_id' => 7, 'name' => 'Wortel Jeruk Apel', 'price' => 10000, 'description' => 'Jus mix sehat kombinasi wortel, jeruk, dan apel'],

            // Snack (ID 3)
            ['category_id' => 3, 'name' => 'Kentang Goreng', 'price' => 6000, 'description' => 'Kentang goreng renyah bumbu asin gurih'],
            ['category_id' => 3, 'name' => 'Mendoan', 'price' => 6000, 'description' => 'Tempe mendoan digoreng setengah matang dengan adonan tepung'],
            ['category_id' => 3, 'name' => 'Cireng', 'price' => 6000, 'description' => 'Camilan aci goreng renyah disajikan dengan bumbu rujak manis pedas'],
            ['category_id' => 3, 'name' => 'Sosis Jumbo Bakar', 'price' => 10000, 'description' => 'Sosis ukuran besar dipanggang dengan olesan saus BBQ dan mayones'],
            ['category_id' => 3, 'name' => 'Sosis Mini Goreng/Bakar', 'price' => 10000, 'description' => 'Sosis mini digoreng atau dibakar matang lezat'],
            ['category_id' => 3, 'name' => 'Roti Bakar', 'price' => 6000, 'description' => 'Roti bakar empuk manis dengan aneka pilihan rasa topping'],
            ['category_id' => 3, 'name' => 'Roti Sosis', 'price' => 10000, 'description' => 'Roti gurih dengan isian sosis lezat'],
            ['category_id' => 3, 'name' => 'Burger King', 'price' => 15000, 'description' => 'Burger roti empuk isi daging burger, sayuran, dan keju'],
            ['category_id' => 3, 'name' => 'Kebab', 'price' => 15000, 'description' => 'Kebab daging panggang iris dibungkus tortilla saus gurih'],
            ['category_id' => 3, 'name' => 'Bakso Mercon', 'price' => 10000, 'description' => 'Bakso sapi pedas cabai setan membakar lidah'],
            ['category_id' => 3, 'name' => 'Bakso Goreng/ Bakar', 'price' => 6000, 'description' => 'Bakso digoreng kering atau dibakar bumbu kecap manis pedas'],
            ['category_id' => 3, 'name' => 'Nugget Stick', 'price' => 6000, 'description' => 'Nugget ayam goreng renyah berbentuk stik'],
            ['category_id' => 3, 'name' => 'Bola Bola Ikan', 'price' => 7000, 'description' => 'Camilan bola ikan goreng gurih lembut di dalam'],

            // Minuman Spesial (ID 9)
            ['category_id' => 9, 'name' => 'Cappuchino', 'price' => 7000, 'description' => 'Minuman kopi espresso dengan foam susu lembut tebal'],
            ['category_id' => 9, 'name' => 'Moccachino', 'price' => 7000, 'description' => 'Cappuchino dengan campuran sirup cokelat manis legit'],
            ['category_id' => 9, 'name' => 'Chocolate', 'price' => 7000, 'description' => 'Minuman susu cokelat premium dingin manis segar'],
            ['category_id' => 9, 'name' => 'Strawberry', 'price' => 7000, 'description' => 'Minuman rasa buah strawberry susu segar manis'],
            ['category_id' => 9, 'name' => 'Lychee', 'price' => 7000, 'description' => 'Minuman rasa buah leci manis menyegarkan dengan es'],
            ['category_id' => 9, 'name' => 'Vanilla', 'price' => 7000, 'description' => 'Minuman rasa vanilla susu creamy harum manis'],
            ['category_id' => 9, 'name' => 'Vanilla Latte', 'price' => 7000, 'description' => 'Espresso dengan susu dan rasa vanilla lembut'],
            ['category_id' => 9, 'name' => 'Taro', 'price' => 7000, 'description' => 'Minuman taro susu ungu creamy khas Kedai Dalia'],
            ['category_id' => 9, 'name' => 'Red Velvet', 'price' => 7000, 'description' => 'Minuman rasa red velvet manis gurih khas cake premium'],
            ['category_id' => 9, 'name' => 'Black Oreo', 'price' => 7000, 'description' => 'Minuman cookies & cream cokelat pekat Oreo blend'],
            ['category_id' => 9, 'name' => 'Thai Tea', 'price' => 7000, 'description' => 'Minuman teh susu khas Thailand rasa legit beraroma rempah'],
            ['category_id' => 9, 'name' => 'Matcha', 'price' => 7000, 'description' => 'Minuman teh hijau Jepang susu creamy manis gurih'],
            ['category_id' => 9, 'name' => 'Melon', 'price' => 7000, 'description' => 'Minuman rasa buah melon manis dingin'],
            ['category_id' => 9, 'name' => 'Mango', 'price' => 7000, 'description' => 'Minuman rasa buah mangga manis menyegarkan'],
            ['category_id' => 9, 'name' => 'Choco Bisquit', 'price' => 7000, 'description' => 'Minuman rasa cokelat berpadu remahan biskuit renyah'],
            ['category_id' => 9, 'name' => 'Coffee Caramel', 'price' => 7000, 'description' => 'Minuman kopi berpadu sirup caramel manis harum'],

            // Seafood Bakar (ID 10)
            ['category_id' => 10, 'name' => 'Bola Ikan', 'price' => 8000, 'description' => 'Sate bakso ikan bakar bumbu kecap manis pedas gurih'],
            ['category_id' => 10, 'name' => 'Bola Udang', 'price' => 10000, 'description' => 'Sate bakso udang bakar lezat khas Kedai Dalia'],
            ['category_id' => 10, 'name' => 'Bola Cumi', 'price' => 10000, 'description' => 'Sate bakso cumi bakar gurih beraroma laut'],
            ['category_id' => 10, 'name' => 'Bola Lobster', 'price' => 10000, 'description' => 'Sate bakso rasa lobster panggang premium'],
            ['category_id' => 10, 'name' => 'Dumpling', 'price' => 10000, 'description' => 'Sate dumpling keju/ayam panggang matang lumer di mulut'],
            ['category_id' => 10, 'name' => 'Cikuwa', 'price' => 10000, 'description' => 'Sate chikuwa bakar olahan ikan khas Jepang'],
            ['category_id' => 10, 'name' => 'Ekor Udang', 'price' => 10000, 'description' => 'Sate ekor udang bakar gurih lezat bumbu meresap'],
            ['category_id' => 10, 'name' => 'Crabstick', 'price' => 10000, 'description' => 'Sate stik kepiting bakar lezat gurih manis'],
            ['category_id' => 10, 'name' => 'Duo Twister', 'price' => 10000, 'description' => 'Sate duo twister panggang beraroma kecap'],

            // New Snack (ID 11)
            ['category_id' => 11, 'name' => 'Dimsum Mix', 'price' => 30000, 'description' => 'Sajian porsi dimsum campur (ayam, udang, dll) kukus hangat lengkap dengan chili oil'],
            ['category_id' => 11, 'name' => 'Roti Maryam Ori', 'price' => 8000, 'description' => 'Roti maryam/canai panggang rasa orisinal margarin'],
            ['category_id' => 11, 'name' => 'Roti Maryam Coklat Keju', 'price' => 10000, 'description' => 'Roti maryam hangat bertabur cokelat meses dan keju parut lumer'],

            // Mocktail (ID 12)
            ['category_id' => 12, 'name' => 'Mojito Lemon', 'price' => 13000, 'description' => 'Mocktail soda dengan irisan jeruk lemon segar dan daun mint'],
            ['category_id' => 12, 'name' => 'Mojito Selasih', 'price' => 13000, 'description' => 'Mocktail soda dingin menyegarkan dengan tambahan biji selasih'],
            ['category_id' => 12, 'name' => 'Mojito Virgin Sparkling', 'price' => 13000, 'description' => 'Mocktail soda sparkling segar aroma citrus'],
            ['category_id' => 12, 'name' => 'Mojito Blue Sky Punch', 'price' => 13000, 'description' => 'Mocktail soda biru segar aroma curacao dan lemon'],
            ['category_id' => 12, 'name' => 'Mojito Morning Vibe', 'price' => 13000, 'description' => 'Mocktail segar pembangkit semangat di pagi/siang hari'],
            ['category_id' => 12, 'name' => 'Mojito Melon Squash', 'price' => 13000, 'description' => 'Soda squash berpadu sirup buah melon dan daun mint'],
            ['category_id' => 12, 'name' => 'Mojito Ocean Blue', 'price' => 13000, 'description' => 'Soda segar biru laut dengan irisan jeruk lemon'],
            ['category_id' => 12, 'name' => 'Mojito Mixberry', 'price' => 15000, 'description' => 'Soda mocktail manis segar dengan buah berry campur'],

            // Milkshake (ID 5)
            ['category_id' => 5, 'name' => 'Milkshake Taro', 'price' => 13000, 'description' => 'Minuman susu kocok dingin rasa taro manis creamy'],
            ['category_id' => 5, 'name' => 'Milkshake Choco Biskuit', 'price' => 13000, 'description' => 'Minuman susu kocok cokelat creamy dengan remahan biskuit'],
            ['category_id' => 5, 'name' => 'Milkshake Vanilla', 'price' => 13000, 'description' => 'Minuman susu kocok manis rasa vanilla klasik'],
            ['category_id' => 5, 'name' => 'Milkshake Red Velvet', 'price' => 13000, 'description' => 'Minuman susu kocok dingin rasa red velvet gurih manis'],
            ['category_id' => 5, 'name' => 'Milkshake Thai Tea', 'price' => 13000, 'description' => 'Thai tea susu kocok dingin aroma rempah manis'],
            ['category_id' => 5, 'name' => 'Milkshake Matcha', 'price' => 13000, 'description' => 'Matcha green tea susu kocok creamy dingin segar'],
            ['category_id' => 5, 'name' => 'Oreo & Nutella Milkshake', 'price' => 15000, 'description' => 'Milkshake premium perpaduan cokelat Nutella manis berpadu cookies Oreo'],
        ];

        foreach ($menusData as $menu) {
            Menu::create([
                'category_id' => $menu['category_id'],
                'name' => $menu['name'],
                'price' => $menu['price'],
                'description' => $menu['description'],
                'status' => 'active',
                'image' => null,
            ]);
        }
    }
}
