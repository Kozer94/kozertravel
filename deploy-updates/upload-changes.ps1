# upload-changes.ps1
# Collects files changed in the last 24 hours and copies them to deploy-updates/

$ProjectRoot  = $PSScriptRoot
$DeployFolder = Join-Path $ProjectRoot "deploy-updates"
$HoursBack    = 24
$Since        = (Get-Date).AddHours(-$HoursBack)

$ExcludedDirs = @(
    'vendor',
    'node_modules',
    'deploy-updates',
    '.git',
    '.claude',
    'storage\logs',
    'storage\framework\cache',
    'storage\framework\sessions',
    'storage\framework\testing'
)

$ExcludedFiles = @(
    '.env',
    '.env.production',
    'database.sqlite',
    'settings.local.json',
    'npm-debug.log',
    'yarn-error.log'
)

function Write-Header ($text) {
    Write-Host "`n$text" -ForegroundColor Cyan
    Write-Host ('-' * $text.Length) -ForegroundColor DarkCyan
}
function Write-Ok   ($text) { Write-Host "  [+] $text" -ForegroundColor Green }
function Write-Skip ($text) { Write-Host "  [-] $text" -ForegroundColor DarkGray }
function Write-Warn ($text) { Write-Host "  [!] $text" -ForegroundColor Yellow }

# ─────────────────────────────────────────
$label1 = [System.Text.Encoding]::UTF8.GetString([System.Text.Encoding]::UTF8.GetBytes("KozerTravel - نقل التغييرات"))
Write-Header $label1
Write-Host "  Since: $($Since.ToString('yyyy-MM-dd HH:mm'))" -ForegroundColor White

if (Test-Path $DeployFolder) {
    Remove-Item $DeployFolder -Recurse -Force
    Write-Warn "Cleared old deploy-updates/"
}
New-Item -ItemType Directory -Path $DeployFolder | Out-Null

# ─────────────────────────────────────────
Write-Header "Scanning files..."

$AllFiles = Get-ChildItem -Path $ProjectRoot -Recurse -File -ErrorAction SilentlyContinue
$Copied   = [System.Collections.Generic.List[string]]::new()
$Skipped  = [System.Collections.Generic.List[string]]::new()

foreach ($File in $AllFiles) {
    $RelativePath = $File.FullName.Substring($ProjectRoot.Length).TrimStart('\')

    $inExcluded = $false
    foreach ($dir in $ExcludedDirs) {
        if ($RelativePath.StartsWith($dir, [System.StringComparison]::OrdinalIgnoreCase)) {
            $inExcluded = $true; break
        }
    }
    if ($inExcluded) { continue }

    if ($ExcludedFiles -contains $File.Name) {
        Write-Skip "SENSITIVE (skipped): $RelativePath"
        $Skipped.Add($RelativePath)
        continue
    }

    if ($File.LastWriteTime -lt $Since) { continue }

    $DestPath = Join-Path $DeployFolder $RelativePath
    $DestDir  = Split-Path $DestPath -Parent

    if (-not (Test-Path $DestDir)) {
        New-Item -ItemType Directory -Path $DestDir -Force | Out-Null
    }

    Copy-Item -Path $File.FullName -Destination $DestPath -Force
    Write-Ok $RelativePath
    $Copied.Add($RelativePath)
}

# ─────────────────────────────────────────
Write-Header "Writing report..."

$ReportPath  = Join-Path $DeployFolder "CHANGED_FILES.txt"
$ReportLines = [System.Collections.Generic.List[string]]::new()
$ReportLines.Add("KozerTravel - Changed Files Report")
$ReportLines.Add("Export date : $(Get-Date -Format 'yyyy-MM-dd HH:mm')")
$ReportLines.Add("Period      : Last $HoursBack hours")
$ReportLines.Add("File count  : $($Copied.Count)")
$ReportLines.Add("")
$ReportLines.Add("Copied files:")
$ReportLines.Add("─────────────")
foreach ($f in $Copied) { $ReportLines.Add("  $f") }

if ($Skipped.Count -gt 0) {
    $ReportLines.Add("")
    $ReportLines.Add("Skipped (sensitive - DO NOT upload):")
    $ReportLines.Add("─────────────────────────────────────")
    foreach ($f in $Skipped) { $ReportLines.Add("  $f") }
}

[System.IO.File]::WriteAllLines($ReportPath, $ReportLines, [System.Text.Encoding]::UTF8)
Write-Ok "Report saved: deploy-updates\CHANGED_FILES.txt"

# ─────────────────────────────────────────
Write-Header "Summary"

if ($Copied.Count -eq 0) {
    Write-Warn "No files changed in the last $HoursBack hours."
} else {
    Write-Host "  Files ready : " -NoNewline; Write-Host $Copied.Count -ForegroundColor Green
    Write-Host "  Folder      : " -NoNewline; Write-Host "deploy-updates\" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "  Hostinger upload steps:" -ForegroundColor White
    Write-Host "  1. Open Hostinger File Manager" -ForegroundColor DarkGray
    Write-Host "  2. Go to public_html/" -ForegroundColor DarkGray
    Write-Host "  3. Upload deploy-updates\ contents keeping folder structure" -ForegroundColor DarkGray
    Write-Host "  4. Files from public\ go into public_html\" -ForegroundColor DarkGray
}

Write-Host ""