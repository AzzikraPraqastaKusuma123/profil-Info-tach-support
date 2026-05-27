Add-Type -Assembly "System.IO.Compression"
Add-Type -Assembly "System.IO.Compression.FileSystem"

$source = "C:\Users\azzik\Documents\Profil PT.ITS 2026\laravel-app"
$dest   = "C:\Users\azzik\Documents\Profil PT.ITS 2026\laravel-app-deploy.zip"

Write-Host "Membaca daftar file dari folder: $source ..."
$files = Get-ChildItem -Path $source -Recurse -Force -File -ErrorAction SilentlyContinue

Write-Host "Total file ditemukan (termasuk .git/hidden): $($files.Count)"

Write-Host "Menyaring file (mengabaikan .git dan node_modules)..."
$filteredFiles = @()
foreach ($file in $files) {
    $fullName = $file.FullName
    # Abaikan jika ada folder .git atau node_modules di dalam path
    if ($fullName -match "\\\.git\\" -or $fullName -match "\\node_modules\\") {
        continue
    }
    $filteredFiles += $file
}

Write-Host "Total file yang akan dikompresi: $($filteredFiles.Count)"
Write-Host "Memulai pembuatan ZIP dengan kompresi cepat (Fastest)..."

$archive = [System.IO.Compression.ZipFile]::Open($dest, [System.IO.Compression.ZipArchiveMode]::Create)

$count = 0
$total = $filteredFiles.Count

foreach ($file in $filteredFiles) {
    # Ambil relative path dari laravel-app
    $relative = $file.FullName.Substring($source.Length + 1)
    $entryName = "laravel-app/" + $relative.Replace("\", "/")
    
    # Tambahkan ke ZIP
    try {
        [System.IO.Compression.ZipFileExtensions]::CreateEntryFromFile(
            $archive,
            $file.FullName,
            $entryName,
            [System.IO.Compression.CompressionLevel]::Fastest
        )
    } catch {
        Write-Warning "Gagal menambahkan file: $($file.FullName). Error: $($_.Exception.Message)"
    }
    
    $count++
    if ($count % 1000 -eq 0 -or $count -eq $total) {
        Write-Host "Kemajuan: $count / $total file ($([math]::Round(($count/$total)*100, 1))%)"
    }
}

$archive.Dispose()

$sizeMB = [math]::Round((Get-Item $dest).Length / 1MB, 2)
Write-Host ""
Write-Host "==================================="
Write-Host "  ZIP BERHASIL DIBUAT!"
Write-Host "  Lokasi : $dest"
Write-Host "  Ukuran : $sizeMB MB"
Write-Host "==================================="
