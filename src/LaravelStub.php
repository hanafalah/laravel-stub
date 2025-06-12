<?php

namespace Hanafalah\LaravelStub;
use Illuminate\Support\Str;

class LaravelStub
{
    /**
     * The stub path.
     *
     * @var string
     */
    protected string $path;

    /**
     * The base path of stub file.
     *
     * @var null|string
     */
    protected static $__base_path = null;

    /**
     * The replacements array.
     *
     * @var array
     */
    protected array $replaces = [];

    /**
     * The contructor.
     *
     * @param string $path
     * @param array  $replaces
     */
    public function __construct($path = '', array $replaces = [])
    {
        if ($path !== '') {
            if (!isset(self::$__base_path)) $this->setBasePath();
            $this->setPath($path)->setRepalcements($replaces);
        }
    }

    /**
     * Create new self instance.
     *
     * @param string $path
     * @param array|callable $replaces
     *
     * @return self
     */
    public function init(string $path = '', array|callable $replaces = []): self
    {
        $path = Str::replace(base_path(),'',$path);
        if (\is_callable($replaces) && !is_string($replaces)) $replaces = $replaces();
        return new static($path, $replaces);
    }

    /**
     * Set stub path.
     *
     * @param string $path
     *
     * @return self
     */
    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Set replacements array.
     *
     * @param array $replaces
     *
     * @return self
     */
    public function setRepalcements(array $replaces): self
    {
        $this->replaces = $replaces;
        return $this;
    }

    /**
     * Get stub path.
     *
     * @return string
     */
    public function getPath(): string
    {
        if (Str::startsWith($this->path, DIRECTORY_SEPARATOR.'stubs')) $this->path = Str::replace(DIRECTORY_SEPARATOR.'stubs', '', $this->path);
        return self::getBasePath() . $this->path;
    }

    /**
     * Set base path.
     *
     * @param string $path
     */
    public static function setBasePath(?string $path = null)
    {
        self::$__base_path = $path ?? \stub_path();
    }

    /**
     * Get base path.
     *
     * @return string|null
     */
    public static function getBasePath(): ?string
    {
        return self::$__base_path;
    }

    /**
     * Get stub contents.
     *
     * @return mixed|string
     */
    public function getContents()
    {
        $contents = file_get_contents($this->getPath());        
        return $this->updateReplaces($contents,$this->replaces);                
    }

    private function updateReplaces($contents, array $replaces){
        $open = config('laravel-stub.stub.open_separator', '$');
        $close = config('laravel-stub.stub.close_separator', '$');
        foreach ($replaces as $search => $replace) {
            //CHECKING IF THE REPLACE IS CALLABLE AND NOT STRING ONLY
            if (\is_callable($replace) && !is_string($replace)) $replace = $replace();
            $needle = $open.$search.$close;
            if (is_array($replace)){
                if (Str::contains($contents,$needle)){
                    $mono_replace = $this->formatArrayAsStub($replace);
                    $contents = str_replace($needle, $mono_replace, $contents);
                }
                $contents = $this->updateReplaces($contents,$replace);
            }else{
                $contents = str_replace($needle, $replace, $contents);
            }
        }
        return $contents;
    }

    public function formatArrayAsStub(array $array, int $indentLevel = 2): string{
        $indent = str_repeat('    ', $indentLevel);
        $lines = ["["];
        $isAssoc = array_keys($array) !== range(0, count($array) - 1);
    
        foreach ($array as $key => $value) {
            if ($isAssoc) {
                $lines[] = "{$indent}'{$key}' => '{$value}',";
            } else {
                $lines[] = "{$indent}'{$value}',";
            }
        }
    
        $lines[] = str_repeat('    ', $indentLevel - 1) . "]";
        return implode("\n", $lines);
    }
    

    /**
     * Get stub contents.
     *
     * @return string
     */
    public function render()
    {
        return $this->getContents();
    }

    /**
     * Save stub to specific path.
     *
     * @param string $path
     * @param string $filename
     *
     * @return bool
     */
    public function saveTo($path, $filename): bool
    {
        if (!is_dir($path)) \mkdir($path, 0777, true);
        return file_put_contents($path . $filename, $this->getContents());
    }

    /**
     * Set replacements array.
     *
     * @param array $replaces
     *
     * @return $this
     */
    public function replace(array $replaces = []): self
    {
        $this->replaces = $replaces;
        return $this;
    }

    /**
     * Get replacements.
     *
     * @return array
     */
    public function getReplaces(): array
    {
        return $this->replaces;
    }

    /**
     * Handle magic method __toString.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
