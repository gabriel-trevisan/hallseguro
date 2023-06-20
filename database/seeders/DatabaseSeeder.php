<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'hookahspacelounge'
        ]);

        $userID = Uuid::uuid4();

        DB::table('users')->insert([
            'id' => $userID,
            'name' => 'Administrador',
            'username' => 'admin',
            'password' => Hash::make('dropdead'),
            'group' => 2, //Admin
            'company_id' => 1
        ]);

        DB::table('documents')->insert([
            'id' => Uuid::uuid4(),
            'company_id' => 1,
            'type' => 1,
            'status' => 1,
            'version' => 1,
            'title' => 'Consentimento LGPD',
            'body' => '<h4 style="text-align:center;"><i><strong>TERMO DE CONSENTIMENTO PARA TRATAMENTO DE DADOS PESSOAIS</strong></i></h4><p>&nbsp;</p><p>Este termo de consentimento foi elaborado em conformidade com a Lei Geral de Proteção de Dados. Consoante ao artigo 5º inciso XII da Lei 13.709, este documento viabiliza a manifestação livre, informada e inequívoca, pela qual o titular concorda com o tratamento de seus dados pessoais para as finalidades descritas no decorrer desse termo.</p><h4>&nbsp;</h4><p style="text-align:center;"><strong>PARÁGRAFO PRIMEIRO&nbsp;</strong></p><p style="text-align:center;"><strong>DO CONSENTIMENTO</strong></p><p>&nbsp;</p><p>Ao declarar que concorda com o presente termo, o <strong>Titular</strong> consente que o estabelecimento <strong>HOOKAH SPACE LOUNGE</strong>, CNPJ nº <strong>34.233.555/0001-03</strong>, com sede na <strong>Rua Orlando Geraldelli, nº 274, Jardim Santa Izabel, Hortolândia, São Paulo, CEP 13.185-240, representada </strong>por<strong> </strong>Alex Fernandes de Sousa,<strong> </strong>telefone <strong>(19) 9970-3584 </strong>e e-mail <strong>alex_fernandes2005@icloud.com</strong>, doravante denominada<strong> Controlador</strong>, proceda com o <strong>tratamento</strong> dos seus dados.</p><p>Entende-se por tratamento de acordo com o artigo 5º inciso X, a coleta, produção, recepção, classificação, utilização, acesso, reprodução, transmissão, distribuição, processamento, arquivamento, armazenamento, eliminação, avaliação ou controle da informação, modificação, comunicação, transferência, difusão ou extração.</p><p>&nbsp;</p><p style="text-align:center;"><strong>PARÁGRAFO SEGUNDO&nbsp;</strong></p><p style="text-align:center;"><strong>DOS DADOS PESSOAIS</strong></p><p style="text-align:center;">&nbsp;</p><p>Poderão ser tratados mediante anuência expressa do titular os seguintes dados pessoais, pelo controlador:</p><p>Nome, RG, telefone, e-mail e foto tirada na recepção.</p><p>&nbsp;</p><p style="text-align:center;"><strong>PARÁGRAFO TERCEIRO&nbsp;</strong></p><p style="text-align:center;"><strong>DA FINALIDADE DO TRATAMENTO</strong></p><p style="text-align:center;">&nbsp;</p><p>Como forma de evitar conflitos dentro do estabelecimento <strong>HOOKAH SPACE LOUNGE, </strong>fez-se necessário a criação deste termo, para que assim, o Controlador possa ter como identificar com maior facilidade o Titular que causar conflitos no estabelecimento, ora citado, e assim bloquear a entrada deste, se futuro retorno, por tempo indeterminado.</p><p>Em atendimento ao artigo 8º, §4, este termo guarda finalidade determinada, sendo que os dados serão utilizados especificamente para fins de:</p><p>Possibilitar que o Controlador faça o cadastro do Titular;</p><p>Possibilitar que o Controlador elabore relatórios informativos, a fim de evitar a entrada desse titular em momento oportuno, caso este gere no estabelecimento conflitos que possam lesar esse Controlador ou terceiros.</p><p>&nbsp;</p><p style="text-align:center;"><strong>PARÁGRAFO QUARTO&nbsp;</strong></p><p style="text-align:center;"><strong>DO COMPARTILHAMENTO DE DADOS</strong></p><p style="text-align:center;">&nbsp;</p><p>O Controlador não está autorizado a compartilhar os dados pessoais do Titular com outros agentes de tratamento de dados.</p><p>&nbsp;</p><p style="text-align:center;"><strong>PARÁGRAFO QUINTO&nbsp;</strong></p><p style="text-align:center;"><strong>DA SEGURANÇA DOS DADOS</strong></p><p>&nbsp;</p><p>O Controlador responsabiliza-se pela manutenção de medidas de segurança, técnicas e administrativas aptas a proteger os dados pessoais de acessos não autorizados e de situações acidentais ou ilícitas de destruição, perda, alteração, comunicação ou qualquer forma de tratamento inadequado ou ilícito.</p><p>Em conformidade ao art. 48 da Lei nº 13.709, o Controlador comunicará ao Titular e à Autoridade Nacional de Proteção de Dados (ANPD) a ocorrência de incidente de segurança que possa acarretar risco ou dano relevante ao Titular.</p><p>Como forma de segurança, os dados fornecidos pelo Titular ficaram armazenados em um servidor Cloud e banco de dados, no qual ambos são hospedados pela empresa Umbler.</p><p>&nbsp;</p><p style="text-align:center;"><strong>PARÁGRAFO SÉTIMO</strong></p><p style="text-align:center;"><strong>DO TÉRMINO DO TRATAMENTO DOS DADOS</strong></p><p style="text-align:center;">&nbsp;</p><p>O Controlador poderá manter e tratar os dados pessoais do Titular durante todo o período em que os mesmos forem pertinentes ao alcance das finalidades listadas neste termo. Dados pessoais anonimizados, sem possibilidade de associação ao indivíduo, poderão ser mantidos por período indefinido.</p><p>&nbsp;</p><p style="text-align:center;"><strong>PARÁGRAFO OITAVO</strong></p><p style="text-align:center;"><strong>DOS DIREITOS DO TITULAR</strong></p><h4 style="text-align:center;">&nbsp;</h4><p>O Titular tem direito a obter do Controlador, em relação aos dados por ele tratados, a qualquer momento e mediante requisição:&nbsp;</p><p>I - confirmação da existência de tratamento;&nbsp;</p><p>II - acesso aos dados;&nbsp;</p><p>III - correção de dados incompletos, inexatos ou desatualizados;&nbsp;</p><p>IV - anonimização, bloqueio ou eliminação de dados desnecessários, excessivos ou tratados em desconformidade com o disposto na Lei nº 13.709;</p><p>V - portabilidade dos dados a outro fornecedor de serviço ou produto, mediante requisição expressa e observados os segredos comercial e industrial, de acordo com a regulamentação do órgão controlador;&nbsp;</p><p>V - portabilidade dos dados a outro fornecedor de serviço ou produto, mediante requisição expressa, de acordo com a regulamentação da autoridade nacional, observados os segredos comercial e industrial;&nbsp;</p><p>VI - eliminação dos dados pessoais tratados com o consentimento do titular, exceto nas hipóteses previstas no art. 16 da Lei nº 13.709;</p><p>VII - informação das entidades públicas e privadas com as quais o controlador realizou uso compartilhado de dados;&nbsp;</p><p>VIII - informação sobre a possibilidade de não fornecer consentimento e sobre as consequências da negativa;&nbsp;</p><p>IX - revogação do consentimento, nos termos do § 5º do art. 8º da Lei nº 13.709.</p><p>&nbsp;</p><p style="text-align:center;"><strong>PARÁGRAFO NONO&nbsp;</strong></p><p style="text-align:center;"><strong>DA REVOGAÇÃO</strong></p><p style="text-align:center;">&nbsp;</p><p>Este consentimento poderá ser revogado pelo <strong>TITULAR</strong>, a qualquer momento, mediante solicitação via e-mail ou correspondência ao <strong>CONTROLADOR</strong>.</p>',
            'user_id' => $userID,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        //Customer::factory(500)->create();
    }
}
