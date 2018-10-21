namespace App\Factory;


class ParseData
{
	protected $separator = "";
	protected $dataNames = [];
	protected $tarihName = "";
	protected $result = [];

	public function __construct ()
	{
	}

	/**
	 * @param string $separator
	 * @param array $dataNames
	 * @return ParseData
	 * @throws \Exception
	 */
	public function setParsingSetting($separator = ":", $dataNames = [], $tarihName = "tarih")
	{
		if (is_null($separator) or count($dataNames) < 1) {
			Throw new \Exception("Separator ve veri adları girilmek zorundadır.");
		}
		$this->separator = $separator;
		$this->dataNames = $dataNames;
		$this->tarihName = $tarihName;
		return $this;
	}

	/**
	 * @param $data
	 * @return array
	 * Datayı alır belirtilen separator a gore bolüp ilgili atamaları yapar ve
	 * oluşan sonucu return eder.
	 * @throws \Exception
	 */
	public function getParsingResult($data)
	{
		if (is_null($data)) {
			Throw new \Exception("Parse edilecek veri gönderilmedi.!");
		}
		$sectors = explode($this->separator, $data, count($this->dataNames));
		for ($i = 0; $i < count($sectors); $i++) {
			if ($this->dataNames[$i] == $this->tarihName)
			{
				$timestamp = strtotime($sectors[$i]);
				$trh = date("Y-m-d H:i:s", $timestamp);
				$this->result[$this->dataNames[$i]] = $trh;
			} else {
				$this->result[$this->dataNames[$i]] = $sectors[$i];
			}
		}
		$this->result["sayilarToplami"] = (int)($this->result["rakam1"] + $this->result["rakam2"] + $this->result["rakam3"] +
			$this->result["rakam4"] + $this->result["rakam5"] + $this->result["rakam6"]);
		return $this->result;
	}

}
