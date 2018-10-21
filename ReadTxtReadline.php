<?php
/**
 * Created by PhpStorm.
 * User: CoDe
 * Date: 19.10.2018
 * Time: 21:28
 */

namespace App\Factory;


class ReadTxtReadline
{
	protected $path = null;		// Dosya yolu.
	protected $fileOpen = null;	// Dosyayı açtık ve bu değişkene atadık.
	protected $rowsAsArray = [];	// Satırları bu diziye ekleyeceğiz.

	/**
	 * ReadTxtReadline constructor.
	 */
	public function __construct ()
	{

	}

	/**
	 * @param $path
	 * @param string $mode
	 * @return $this
	 * @throws \Exception
	 * Verilen path geçersiz ise hata dondürür. mode default olarak read dır.
	 */
	public function openFile($path, $mode="r")
	{
		if (!file_exists($path))
		{
			throw new \Exception("Belirtilen dosya bulunamadı..!");
		}
		$this->path = $path;
		$this->fileOpen = fopen($path, $mode);
		return $this;
	}

	/**
	 * @return $this
	 * Dosya içeriğini satır satır okuyup $rowsAsArray dizisine satırları ekliyoruz.
	 */
	protected function setRowsAsArrays()
	{
		while(!feof($this->fileOpen)){
			$row = fgets($this->fileOpen);
			array_push($this->rowsAsArray, $row);
		}
		return $this;
	}

	/**
	 * @return array
	 * Diziye eklenmiş satırları return ettik.
	 */
	public function getRowsAsArray()
	{
		$this->setRowsAsArrays();	// SAtırları diziye eklettik.
		return $this->rowsAsArray;
	}

	/**
	 * Eğer dosyayı başarılı şekilde açmışsak sınıf sonunda balğantıyı kapatıyoruz.
	 */
	public function __destruct ()
	{
		// TODO: Implement __destruct() method.
		if (!is_null($this->fileOpen)) {
			fclose($this->fileOpen);
		}
	}
}
