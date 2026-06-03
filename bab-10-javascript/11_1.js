// Mengambil input dari user
let bil1 = Number(prompt("Masukkan bilangan pertama:"));
let bil2 = Number(prompt("Masukkan bilangan kedua:"));

// Cek kondisi dan tampilkan hasil
if (isNaN(bil1) || isNaN(bil2)) {
    alert("Mohon masukkan angka yang valid!");
} else if (bil1 > bil2) {
    alert("BILANGAN KE-1 LEBIH BESAR DARI BILANGAN KE-2");
} else if (bil1 < bil2) {
    alert("BILANGAN KE-2 LEBIH BESAR DARI BILANGAN KE-1");
} else {
    alert("KEDUA BILANGAN SAMA BESAR");
}