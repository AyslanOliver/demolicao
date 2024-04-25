<script>
    function consultarEmpresa() {
        var cnpj = document.getElementById('cnpj').value;

        // Verificar se o CNPJ foi fornecido
        if (!cnpj) {
            alert('Por favor, insira um CNPJ válido.');
            return;
        }

        // Enviar uma solicitação AJAX para o servidor
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'consulta_empresa.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Preencher os campos com os dados da empresa
                        document.getElementById('razao_social').value = response.razao_social;
                        document.getElementById('nome_fantasia').value = response.nome_fantasia;
                    } else {
                        alert('Erro ao consultar empresa: ' + response.error);
                    }
                } else {
                    alert('Erro ao realizar a solicitação.');
                }
            }
        };
        xhr.send('cnpj=' + encodeURIComponent(cnpj));
    }
</script>
