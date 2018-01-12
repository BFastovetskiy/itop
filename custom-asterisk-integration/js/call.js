function CallToCustomer(pAgent, pCustomer)
{
    sUrl = GetAbsoluteUrlModulePage('custom-asterisk-integration', 'call.php');
    $.get(sUrl,{ agent: pAgent, customer: pCustomer});
}