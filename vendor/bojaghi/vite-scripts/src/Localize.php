<?php

namespace SWPMU\TermMerger\Vendor\Bojaghi\ViteScripts;

class Localize
{
    public static function create(ViteScript $vs, string $handle): self
    {
        return new self($vs, $handle);
    }

    private function __construct(
        private ViteScript $vs,
        private string     $handle,
    )
    {
    }

    public function scriptTranslation(string $domain = 'default', string $path = ''): Localize
    {
        wp_set_script_translations($this->handle, $domain, $path);

        return $this;
    }

    public function vars(string $varName, array $varValue): ViteScript
    {
        wp_localize_script($this->handle, $varName, $varValue);

        if ($this->vs->isDevelopment()) {
            wp_add_inline_script(
                $this->handle,
                "console.info('$this->handle: $varName', window.$varName);",
            );
        }

        return $this->vs;
    }
}
