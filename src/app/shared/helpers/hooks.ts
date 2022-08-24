export function handlePercentMask(num1:number, num2:number, fixed:number) {
  let calc = ((num1/num2)*100)
  return isNaN(calc) ? 0 : calc === 100 ? calc : calc.toFixed(fixed)
}

export function formatCnpj(v: string): string{
  v = v.replace(/\D/g, '')                           // Remove tudo o que não é dígito
  v = v.replace(/^(\d{2})(\d)/, '$1.$2')             // Coloca ponto entre o segundo e o terceiro dígitos
  v = v.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3') // Coloca ponto entre o quinto e o sexto dígitos
  v = v.replace(/\.(\d{3})(\d)/, '.$1/$2')           // Coloca uma barra entre o oitavo e o nono dígitos
  v = v.replace(/(\d{4})(\d)/, '$1-$2')              // Coloca um hífen depois do bloco de quatro dígitos
  return v
}

export function formatCpf(v: string): string{
  v = v.replace(/\D/g, '')                    // Remove tudo o que não é dígito
  v = v.replace(/(\d{3})(\d)/, '$1.$2')       // Coloca um ponto entre o terceiro e o quarto dígitos
  v = v.replace(/(\d{3})(\d)/, '$1.$2')       // Coloca um ponto entre o terceiro e o quarto dígitos
                                           // de novo (para o segundo bloco de números)
  v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2') // Coloca um hífen entre o terceiro e o quarto dígitos
  return v
}

export function formatPhone(str: string): any{
  // Filter only numbers from the input
  const cleaned = ('' + str).replace(/\D/g, '')

  // Check if the input is of correct length
  const match = cleaned.match(/^(\d{2})(\d{5})(\d{4})$/)

  if (match) {
    return '(' + match[1] + ') ' + match[2] + '-' + match[3]
  }

  return null
}

export function maskDate(date: string): string{
  return new Date(date).toLocaleDateString('pt-BR')
}

export function maskDateBar(date: string): string{
  return date.replace(/[/]/g,'-').split(/\D/).reverse().join('-')
}

export function maskDateHyphen(date: string): string{
  return date.replace(/[-]/g,'/').split(/\D/).reverse().join('/')
}