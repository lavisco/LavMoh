<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block">
            @if (trim($slot) === 'Lavisco')
            <img
                src="https://s3.us-west-2.amazonaws.com/secure.notion-static.com/e3cd7bef-f9fa-4855-b479-c560b660f92e/new_lavisco.lk_Logo_PNG.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Credential=AKIAT73L2G45EIPT3X45%2F20220308%2Fus-west-2%2Fs3%2Faws4_request&X-Amz-Date=20220308T193723Z&X-Amz-Expires=86400&X-Amz-Signature=43f679dd8720bc5b30d0a83eb78b20c2e60fc7be4d94ad053325db1887c2d150&X-Amz-SignedHeaders=host&response-content-disposition=filename%20%3D%22new%2520lavisco.lk%2520Logo%2520PNG.png%22&x-id=GetObject"
                class="logo"
                alt="Lavisco Logo"
            />
            @else
            {{ $slot }}
            @endif
        </a>
    </td>
</tr>
