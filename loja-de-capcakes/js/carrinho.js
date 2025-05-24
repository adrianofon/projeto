document.addEventListener('DOMContentLoaded', function () {
    const carrinho = [];

    function adicionarItemAoCarrinho(id, preco, codigo) {
        const itemExistente = carrinho.find(item => item.id === id);

        if (itemExistente) {
            // Se o item já existe no carrinho, incrementa a quantidade
            itemExistente.quantidade += 1;
        } else {
            // Caso contrário, adiciona um novo item ao carrinho
            const novoItem = {
                id: id,
                preco: preco,
                quantidade: 1,
                codigo: codigo // Adiciona o código ao objeto do item
            };
            carrinho.push(novoItem);
        }

        atualizarCarrinhoNaInterface();
    }

    function atualizarCarrinhoNaInterface() {
        const carrinhoDiv = document.getElementById('carrinho');
        const itensCarrinho = document.getElementById('itens-carrinho');
        const totalCarrinho = document.getElementById('total-carrinho');
        totalCarrinho.textContent = calcularTotalCarrinho().toFixed(2);

        itensCarrinho.innerHTML = '';
        carrinho.forEach(item => {
            const listItem = document.createElement('li');
            listItem.textContent = `Produto: ${idParaNome(item.id)}, Quantidade: ${item.quantidade}, Preço: R$ ${item.preco.toFixed(2)}, Código: ${item.codigo}`;
            itensCarrinho.appendChild(listItem);
        });
    }

    function calcularTotalCarrinho() {
        return carrinho.reduce((total, item) => total + item.preco * item.quantidade, 0);
    }

    function idParaNome(id) {
        switch (id) {
            case 'adicionar-ao-carrinho-1':
                return 'Cupcake de Chocolate';
            case 'adicionar-ao-carrinho-2':
                return 'Cupcake de Morango';
            case 'adicionar-ao-carrinho-3':
                return 'Cupcake de Baunilha';
            case 'adicionar-ao-carrinho-4':
                return 'Cupcake Red Velvet';
            case 'adicionar-ao-carrinho-5':
                return 'Cupcake de Framboesa';
            case 'adicionar-ao-carrinho-6':
                return 'Cupcake de Limão';
            case 'adicionar-ao-carrinho-7':
                return 'Cupcake de Cereja e Chocolate';
            case 'adicionar-ao-carrinho-8':
                return 'Cupcake de Maracujá e Coco';
            case 'adicionar-ao-carrinho-9':
                return 'Cupcake de Amendoim';
            case 'adicionar-ao-carrinho-10':
                return 'Cupcake de Pêssego e Amêndoas';
            default:
                return 'Produto Desconhecido';
        }
    }

    document.querySelectorAll('button[id^="adicionar-ao-carrinho-"]').forEach(button => {
        const id = button.id;
        const preco = parseFloat(button.getAttribute('data-preco'));
        const codigo = button.getAttribute('data-codigo'); // Obtém o código do botão

        button.addEventListener('click', () => {
            adicionarItemAoCarrinho(id, preco, codigo);
            console.log(`Item ${idParaNome(id)} adicionado ao carrinho.`);
        });
    });
});
