[Reflection.Assembly]::LoadWithPartialName("Microsoft.WindowsAzure.ServiceRuntime")

.\install-php-impl.cmd
	
# Get PHP installation details
$phpInstallDir = "${env:ProgramFiles(x86)}\PHP\v5.5\"
$phpExecutable = $phpInstallDir + "php.exe"
$phpExtensionsPath = $phpInstallDir + "\ext"
$phpIniFile = $phpInstallDir + "php.ini"
	
# Get PHP installation override details
$myExtensionsPath = "..\app\azure\php\ext"
$myExtensions = Get-ChildItem $myExtensionsPath | where {$_.Name.ToLower().EndsWith(".dll")}
$myPhpIniFile = "..\app\azure\php\php.ini"
	
# Append PHP.ini directives only if not already done
if ((Test-Path $myPhpIniFile) -eq 'True') {
	if (!(cat $phpIniFile | Select-String 'PhpAzureChanges')) {
		$additionalPhpIniDirectives = Get-Content $myPhpIniFile
		$additionalPhpIniDirectives = $additionalPhpIniDirectives.Replace("%EXT%", $phpExtensionsPath)
		Add-Content $phpIniFile "`r`n"
		Add-Content $phpIniFile $additionalPhpIniDirectives
	}
}
	
# Copy and register extensions
foreach ($myExtension in $myExtensions) {
	Copy-Item $myExtension.FullName $phpExtensionsPath
} 
