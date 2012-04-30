<?php
namespace SandstormMedia\Utilities\Command;

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Img trans cmd controller
 *
 * @FLOW3\Scope("singleton")
 */
class ImageCommandController extends \TYPO3\FLOW3\Cli\CommandController {


	/**
	 * @var \Imagine\Image\ImagineInterface
	 */
	protected $imagine;

	public function injectObjectManager(\TYPO3\FLOW3\Object\ObjectManagerInterface $objectManager) {
		$this->imagine = $objectManager->get('Imagine\Image\ImagineInterface');
	}

	/**
	 *
	 * @param string $inputImage
	 * @param string $outputImageBaseName
	 * @param integer $x
	 * @param integer $y
	 * @param integer $w
	 * @param integer $h
	 */
	public function makeTransparentCommand($inputImage, $outputImageBaseName, $x, $y, $w, $h) {
		echo "1";
		$image = $this->imagine->open($inputImage);
		$image->crop(new \Imagine\Image\Point($x, $y), new \Imagine\Image\Box($w, $h));

		$imageMask = $image->mask();

		echo "2";
		$image->applyMask($imageMask);
		echo "3";

		$image->save($outputImageBaseName . '-horiz.png');

		$image->rotate(90);

		$image->save($outputImageBaseName . '-vert.png');
	}

}
?>