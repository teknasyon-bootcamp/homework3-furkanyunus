<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */

class Form {
    public array $fields = [];//inputların dizisi

    // default construct fonksiyonu
    private function __construct(
        public string $action,
        public string $method,
    ) 
    { }

    // Post formu olusturmak için kullanılan fonksiyon
    public static function createPostForm(string $action): Form
    {
        $PostForm=self::createForm($action, 'POST');
        return $PostForm;
    }

    // Get methodunun formunu olusturan fonksiyon
    public static function createGetForm(string $action): Form
    {
        $GetForm=self::createForm($action, 'GET');
        return $GetForm;
    }

    // Form için oluşturulan fonksiyon
    public static function createForm(string $action, string $method): Form
    {
        $CreateForm=new Form($action, $method);
        return $CreateForm;
    }

    // form için istenen Degerleri array'e ekleyen fonksiyon
    public function addField(string $label, string $name, string $defaultValue = null): void
    {
        $field = [
            "label" => $label,
            "name"  => $name,
            "value" => $defaultValue,
        ];

        $this->fields[] = $field;
    }

    //method değişimi için kullanılan fonksiyon
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    // Formu html olarak alan fonksiyon
    public function render(): void
    {        echo "<form action='".$this->action."' method='".$this->method."'>";
        foreach($this->fields as $field){
            echo "<label for='".$field["label"]."'>".$field["label"]."</label>";
            if(isset($field["defaultValue"])){
                echo "<input type='text' name='".$field["name"]."' value='".$field["defaultValue"]."'/>";
            }
            else{
                echo "<input type='text' name='".$field["name"]."'/>";
            }
        }
        echo "<button type='Submit'>Gönder</button>";
        echo "</form>";
    }
}
