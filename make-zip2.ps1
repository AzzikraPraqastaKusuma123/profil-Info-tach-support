Add-Type -Assembly "System.IO.Compression.FileSystem"

$source = "C:\Users\azzik\Documents\Profil PT.ITS 2026\laravel-app"
$dest   = "C:\Users\azzik\Documents\Profil PT.ITS 2026\laravel-app-deploy.zip"

# Hapus ZIP lama jika ada
if (Test-Path $dest) {
    Remove-Item $dest -Force
    Write-Host "File ZIP lama dihapus."
}

Write-Host "Memulai kompresi... ini mungkin butuh 2-5 menit karena folder vendor cukup besar."

# Buat ZIP menggunakan .NET ZipFile (lebih stabil dari Compress-Archive)
[System.IO.Compression.ZipFile]::CreateFromDirectory(
    $source,
    $dest,
    [System.IO.Compression.CompressionLevel]::Optimal,
    $true  # includeBaseDirectory = true, jadi folder laravel-app ikut terbungkus
)

$sizeMB = [math]::Round((Get-Item $dest).Length / 1MB, 2)
Write-Host ""
Write-Host "==================================="
Write-Host "  ZIP BERHASIL DIBUAT!"
Write-Host "  Lokasi : $dest"
Write-Host "  Ukuran : $sizeMB MB"
Write-Host "==================================="
