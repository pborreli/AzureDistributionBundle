<?php

namespace WindowsAzure\DistributionBundle\Tests\Blob;

use WindowsAzure\DistributionBundle\Filesystem\AzureFilesystem;

class AzureFilesystemTest extends BlobTestCase
{
    public function testMkdirs()
    {
        $containerName = $this->generateName();

        $blobClient = $this->createBlobClient();
        mkdir("azure://". $containerName);

        $filesystem = new AzureFilesystem();
        $filesystem->mkdir(array(
            "azure://". $containerName,
            "azure://" . $containerName . "/foo/bar"
        ));

        $this->assertTrue(file_exists("azure://". $containerName));
        $this->assertTrue(file_exists("azure://" . $containerName . "/foo/bar"));
    }
}

