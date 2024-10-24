<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserProfileIcon extends Component
{
    public string $name;
    public string $width;
    public string $height;
    public string $shortName;
    public string $backgroundColor;

    public function __construct(
        string $name,
        string $width = '10',
        string $height = '10',
    )
    {
        $this->name = $name;
        $this->width = $width;
        $this->height = $height;
        $this->shortName = $this->getShortName($name);
        $this->backgroundColor = $this->generateBackgroundColor($name);
    }

    private function getShortName(string $name): string
    {
        $parts = explode(' ', $name);
        if (count($parts) > 1) {
            return strtoupper($parts[0][0] . $parts[1][0]);
        }
        return strtoupper(substr($name, 0, 2));
    }

    private function generateBackgroundColor(string $name): string
    {
        $hash = md5($name);
        return '#' . substr($hash, 0, 6);
    }

    public function render(): View|Closure|string
    {
        return view('components.user-profile-icon');
    }
}
