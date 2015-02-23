<?php

/**
 * (c) FSi sp. z o.o. <info@fsi.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FSi\Bundle\GalleryBundle\Behat\Context;

use Behat\Gherkin\Node\TableNode;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\SchemaTool;
use Faker\Factory;
use Faker\ORM\Doctrine\Populator;
use FSi\FixturesBundle\Entity\Gallery;
use FSi\FixturesBundle\Entity\Photo;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class DataContext extends PageObjectContext
{
    private $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * @BeforeScenario
     */
    public function createDatabase()
    {
        $this->deleteDatabaseIfExist();
        $metadata = $this->getDoctrine()->getManager()->getMetadataFactory()->getAllMetadata();
        $tool = new SchemaTool($this->getDoctrine()->getManager());
        $tool->createSchema($metadata);
    }

    /**
     * @AfterScenario
     */
    public function deleteDatabaseIfExist()
    {
        $dbFilePath = $this->kernel->getRootDir() . '/data.sqlite';

        if (file_exists($dbFilePath)) {
            unlink($dbFilePath);
        }
    }

    /**
     * @AfterScenario
     */
    public function deleteWebFolder()
    {
        $path = realpath($this->kernel->getRootDir() . '/../web');

        if (file_exists($path)) {
            self::deleteDir($path, true);
        }
    }

    /**
     * @param $dir
     */
    public static function deleteDir($dir, $onlyContents = false) {
        $iterator = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::CHILD_FIRST);
        foreach ($files as $file) {
            if (strpos($file->getPathname(), 'app_test.php') !== false) {
                continue;
            }
            if ($file->isDir()) {
                rmdir($file->getPathname());
            } else {
                unlink($file->getPathname());
            }
        }
        if ($onlyContents === false) {
            rmdir($dir);
        }
    }

    /**
     * @Given /^there are following galleries$/
     */
    public function thereAreFollowingGalleries(TableNode $galleries)
    {
        $generator = Factory::create();
        $imagesDir = $this->createGalleryFixturesDir();

        foreach ($galleries->getHash() as $galleryData) {
            $photos = new ArrayCollection();
            for ($i = 0; $i < (int) $galleryData['Photos count']; $i++) {
                $image = $generator->image($imagesDir, 600, 400);
                $imageFile = new UploadedFile(
                    $image,
                    basename($image),
                    null,
                    null,
                    null,
                    true
                );

                $photo = new Photo();
                $photo->setPhoto($imageFile);

                $this->getDoctrine()->getManager()->persist($photo);
                $this->getDoctrine()->getManager()->flush();

                $photos->add($photo);
            }

            $gallery = new Gallery();
            $gallery->setName($galleryData['Name']);
            $gallery->setDescription($galleryData['Description']);
            $gallery->setVisible($galleryData['Visible'] === 'true');
            $gallery->setPhotos($photos);

            $this->getDoctrine()->getManager()->persist($gallery);
            $this->getDoctrine()->getManager()->flush();
            $this->getDoctrine()->getManager()->clear();
        }

        $this->removeFixtures($imagesDir);
    }

    /**
     * @Given /^there are (\d+) visible galleries$/
     */
    public function thereAreVisibleGalleries($galleriesCount)
    {
        $generator = Factory::create();
        $populator = new Populator($generator, $this->getDoctrine()->getManager());
        $populator->addEntity('FSi\FixturesBundle\Entity\Gallery', (int) $galleriesCount, array(
            'visible' => true
        ));
        $populator->execute();
    }

    /**
     * @param string $name
     * @return Gallery
     */
    public function findGalleryByName($name)
    {
        return $this->getDoctrine()->getRepository('FSi\FixturesBundle\Entity\Gallery')
            ->findOneBy(array('name' => $name));
    }

    /**
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    public function getDoctrine()
    {
        return $this->kernel->getContainer()->get('doctrine');
    }

    /**
     * @return string
     */
    private function createGalleryFixturesDir()
    {
        $imagesDir = sys_get_temp_dir() . '/gallery_fixtures';
        if (!file_exists($imagesDir)) {
            mkdir($imagesDir);
            return $imagesDir;
        }
        return $imagesDir;
    }

    /**
     * @param $imagesDir
     */
    private function removeFixtures($imagesDir)
    {
        foreach (new \DirectoryIterator($imagesDir) as $fileInfo) {
            if ($fileInfo->isFile()) {
                unlink($fileInfo->getPathname());
            }
        }

        rmdir($imagesDir);
    }
}