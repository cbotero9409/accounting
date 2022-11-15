
function selectRetention(retention) {
    var retention_text = retention.options[retention.selectedIndex].text;
    var ret = retention_text.substring(0, retention_text.indexOf(" "));
    const code_input = document.getElementById('retentions-code');
    code_input.value = ret; 
}

function selectMove(movement) {
    const payroll = document.getElementById('payroll');    
    if (movement == '1' || movement == '2') {
        payroll.classList.remove('d-none');
    } else {
        payroll.classList.add('d-none');
        const exp_acc = document.getElementById('retentions-expense_account');
        exp_acc.value = '';
        const cost_c = document.getElementById('retentions-cost_center');
        cost_c.value = '';
    }
}