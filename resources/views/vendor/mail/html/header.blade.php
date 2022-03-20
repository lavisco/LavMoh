<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block">
            @if (trim($slot) === 'Lavisco')
            <img
                src="{{ Storage::disk('s3')->temporaryUrl('public/images/lavisco_logo_min.png', '+2 minutes') }}"
                class="logo"
                alt="Lavisco"
            />
            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>
