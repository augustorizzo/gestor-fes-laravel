package principal;

import DAO.BoladaoDAO;
import Entidade.Rota;
import Entidade.Tabela;
import Entidade.Util;
import java.io.IOException;

/**
 *
 * @author ronney
 */
public class ConsoleMain
{

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException
    {        
        String comando = "";
        
        boolean sair = false;
        
        Util.printaln(String.format(">>#################### BOLADÃO v%s ####################<<",Util.GetConfig("versao")));
        
        Util.CarregaEnv();
        Util.printaln("Sistema => " + Util.GetPropriedade("APP_SISTEMA"));
        
        
       while(!sair)
       {
           //Util.printa("comando=> ");
           comando = Util.LeComando("Menu");
           
           if(!comando.isEmpty())
           {
               switch(comando.toLowerCase())
               {
                   case "exit":
                        sair = true;
                        break;
                   case "load:env":
                       Util.CarregaEnv();
                       break;
                   case "sobre":
                       Util.printaln("  -> Desenvolvido por Ronney Viana\n");
                       break;
                    case "model":
                        Model();
                        break;
                    case "rotas":
                    case "rota":
                        ConsoleMain.Rotas();
                        break;
                    case "help":
                        ConsoleMain.ListaComandos();
                        break;
                    
                    default:
                        Util.printaln("Comando não reconhecido. em caso de dúvida digite 'help'");
                        break;
               }
           }
           else
           {
               ConsoleMain.ListaComandos();
           }
       }   
        
    }
    
    public static void ListaComandos()
    {
        Util.printaln("\n################### Lista de comandos ###################");
        
        Util.printaln
        (
             " - help -> Lista os comandos do console \n"
           + " - load:env -> Recarrega no console o arquivo .env \n"
           + " - model -> acessa o módulo Models \n"
           + " - rota  -> acessa o módulo Rotas \n"
           + " - sobre -> Mostra os créditos do console \n\n"
        );
    }
    
    public static void Model()
    {
        boolean sair = false;
                
        while(!sair)
        {
            String comando = Util.LeComando("Model");
            
            switch(comando.toLowerCase())
            {
                 default:
                    Util.printaln("comando não encontrado. Para listar digite 'help'.");
                    break;
                case "exit":
                    sair = true;
                    break;
                case "gera":
                case "gerar":
                    Util.printaln("/* Digite as tabelas separadas por ','(ex: TUR_idioma,TUR_cliente..) ou o padrão das tabelas(ex: padrao=TUR_) */");
                    
                    String linha = Util.LeComando("Model:gerar");
                    
                    if(linha.isEmpty())
                    {
                        Util.printaln(" -> Nenhuma tabela ou padrão indicado");
                    }
                    else
                    {
                        String[] tbls = linha.split(",");
                        String padrao = null;

                        if(tbls.length == 1)
                        {
                            String[] arrPadrao = linha.split("=");
                            if(arrPadrao.length == 2)
                            {
                                padrao = arrPadrao[1];
                                tbls = null;
                            }
                        }

                        try   
                        {            
                            for(Tabela tabela : new BoladaoDAO().GetTabelas(Util.GetPropriedade("DB_DATABASE"),tbls,padrao))
                            {   
                                Util.printa("   -> Gerando model da tabela => " + tabela.getNome());

                                //gera Model
                                Util.GeraArquivo(String.format("%s%s.php",Util.GetConfig("pasta_app"),tabela.getNomeArquivo()),tabela.GeraModel());

                                Util.printaln(".... OK");
                            }

                            Util.printaln(" -> geração de models finalizada.");
                        }
                        catch(Exception ex)
                        {
                            Util.printaln("erro : " + ex.getMessage());
                        }
                    }
                    
                    break;
                
                case "help":
                case "":
                    Util.printaln
                    (
                         " - help -> lista os comandos do console \n"
                       + " - gerar -> gera o arquivo model com base na tabela indicada \n"
                       + " - exit -> volta para o Módulo principal \n\n"
                    );
                    break;
            }
        }
    }
    
    public static void Rotas()
    {
        boolean sair = false;
                
        while(!sair)
        {
            String comando = Util.LeComando("Rota");
            
            if(!comando.isEmpty())
            {
                switch(comando.toLowerCase())
                {
                    default:
                        Util.printaln("comando não encontrado. Para listar digite 'help'.");
                        break;
                    case "exit":
                        sair = true;
                        break;
                    case "load":
                        Util.CarregaRotas();
                        break;
                    case "lista":
                    case "listar":
                        for(Rota rota : Util.GetRotas())
                        {
                            Util.printaln(" -> " + rota.GetRota());
                        }
                        break;
                    case "atualiza":
                    case "atualizar":

                        try
                        {
                            for(Rota rota : Util.GetRotas())
                            {
                               Util.printa("Inserindo rota " + rota.getNome() + "....");

                               new BoladaoDAO().InsereRota(rota);

                               Util.printaln("ok");
                            }

                        }
                        catch(Exception ex)
                        {
                            Util.printaln("Erro ao tentar inserir as rotas: " + ex.getMessage());
                        }
                        
                        break;
                        
                    case "help":
                    case "":
                        Util.printaln
                        (
                             " - help -> lista os comandos do console \n"
                           + " - load -> recarrega as rotas do arquivo routes/web.php \n"
                           + " - listar -> lista as rotas do carregadas do arquivo routes/web.php \n"
                           + " - atualizar -> atualia a tabela de rotas no banco de dados com as rotas do arquivo routes/web.php atual \n"
                           + " - exit -> volta para o Módulo principal \n\n"
                        );
                    break;
                }                
            }
        }
    }
    
    public static void Crud()
    {
        boolean sair = false;
                
        while(!sair)
        {
            String comando = Util.LeComando("CRUD");
            
            switch(comando.toLowerCase())
            {
                 default:
                    Util.printaln("comando não encontrado. Para listar digite 'help'.");
                    break;
                case "exit":
                    sair = true;
                    break;
                case "gera":
                case "gerar":
                    Util.printaln("/* Digite as tabelas separadas por ','(ex: TUR_idioma,TUR_cliente..) ou o padrão das tabelas(ex: padrao=TUR_) */");
                    
                    String linha = Util.LeComando("CRUD:gerar");
                    
                    if(linha.isEmpty())
                    {
                        Util.printaln(" -> Nenhuma tabela ou padrão indicado");
                    }
                    else
                    {
                        String[] tbls = linha.split(",");
                        String padrao = null;

                        if(tbls.length == 1)
                        {
                            String[] arrPadrao = linha.split("=");
                            if(arrPadrao.length == 2)
                            {
                                padrao = arrPadrao[1];
                                tbls = null;
                            }
                        }

                        try   
                        {            
                            for(Tabela tabela : new BoladaoDAO().GetTabelas(Util.GetPropriedade("DB_DATABASE"),tbls,padrao))
                            {   
                                Util.printa("   -> Gerando model da tabela => " + tabela.getNome());

                                //gera Model
                                Util.GeraArquivo(String.format("%s%s.php",Util.GetConfig("pasta_app"),tabela.getNomeArquivo()),tabela.GeraModel());

                                Util.printaln(".... OK");
                            }

                            Util.printaln(" -> geração de models finalizada.");
                        }
                        catch(Exception ex)
                        {
                            Util.printaln("erro : " + ex.getMessage());
                        }
                    }
                    
                    break;
                
                case "help":
                case "":
                    Util.printaln
                    (
                         " - help -> lista os comandos do console \n"
                       + " - gerar -> gera o arquivo model com base na tabela indicada \n"
                       + " - exit -> volta para o Módulo principal \n\n"
                    );
                    break;
            }
        }
    }
    
}
    
    