$source = "C:\Users\azzik\Documents\Profil PT.ITS 2026\laravel-app"
$dest   = "C:\Users\azzik\Documents\Profil PT.ITS 2026\laravel-app-deploy.zip"

if (Test-Path $dest) {
    Remove-Item $dest
    Write-Host "File ZIP lama dihapus."
}

Write-Host "Memulai kompresi, mohon tunggu..."
Compress-Archive -Path $source -DestinationPath $dest -CompressionLevel Optimal

$sizeMB = [math]::Round((Get-Item $dest).Length / 1MB, 2)
Write-Host "ZIP selesai dibuat!"
Write-Host "Lokasi: $dest"
Write-Host "Ukuran: $sizeMB MB"
