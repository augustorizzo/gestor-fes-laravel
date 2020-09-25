package Entidade;

import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.io.Serializable;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Properties;
import java.util.Scanner;

/**
 *
 * @author ronney
 */
public class Util implements Serializable
{
    public static HashMap<String,String> env;
    private static Properties propConfig;
    private static Scanner console;
    private static List<Rota> rotas;
    
    public static void CarregaRotas()
    {
        try
        {
            if(Util.rotas == null)
            {
                Util.rotas = new ArrayList<Rota>();
            }
            else
            {
                Util.rotas.clear();
            }
            
            FileReader frRota = new FileReader(Util.GetConfig("/arquivo_rotas"));
            BufferedReader bfRota= new BufferedReader(frRota);

            String linha = bfRota.readLine();

            while(linha != null)
            {
                //printaln(linha);
                
                if(linha.length() > 5 && linha.substring(0,5).equalsIgnoreCase("Route") && !linha.contains("ajax"))
                {
                    String p1 = linha.replaceAll("Route::", "");
                    String endereco = p1.substring(p1.indexOf("('")+2,p1.indexOf("',"));
                    
                    if(!endereco.equalsIgnoreCase("/") && !endereco.equalsIgnoreCase("/home"))
                    {
                        String p2 = p1.split(",")[1].trim();
                                
                        Rota rota = new Rota();

                        rota.setHttp(p1.substring(0,p1.indexOf("(")));
                        rota.setEndereco(endereco);
                        rota.setController(p2.substring(1,p2.indexOf("@")));
                        rota.setMetodo(p2.substring(p2.indexOf("@") + 1,p2.indexOf("')->")));
                        rota.setApelido(p2.substring(p2.indexOf("('")+2,p2.indexOf("');")));
                        
                        Util.rotas.add(rota);
                    }
                }

                linha = bfRota.readLine();
            }

            bfRota.close();
            frRota.close();
            
            Util.printaln(" -> Arquivo de rotas lido com sucesso.");
        }
        catch(Exception ex)
        {
            Util.printaln("Erro ao carregar uma ou mais rotas: " + ex.getMessage());
        }
    }
            
    public static void CarregaEnv()
    {
        try
        {
            if(Util.env == null)
            {
                Util.env = new HashMap<String,String>();
            }
            else
            {
                Util.env.clear();
            }
            
            FileReader frArquivo = new FileReader(Util.GetConfig("pasta_raiz_projeto") +".env");
            BufferedReader bfEnv = new BufferedReader(frArquivo);

            String linha = bfEnv.readLine();

            while(linha != null)
            {
                if(linha.contains("="))
                {
                    String[] map = linha.split("=");
                    
                    if(map.length == 2)
                    {
                        Util.env.put(map[0].trim(), map[1].trim());
                    }
                }

                linha = bfEnv.readLine();
            }

            bfEnv.close();
            frArquivo.close();
            
            Util.printaln("env carregado com sucesso.");
        }
        catch(Exception ex)
        {
            Util.printaln("Erro ao recarregar o env: " + ex.getMessage());
        }
    }
    
    public static String GetPropriedade(String key)
    {
        if(Util.env == null)
        {
            Util.env = new HashMap<String,String>();
            Util.CarregaEnv();
        }
        
        return Util.env.get(key);
    }
    
    public static boolean GeraArquivo(String caminhoArquivo,String conteudo) throws FileNotFoundException
    {
        PrintWriter writer = new PrintWriter(caminhoArquivo);
        writer.print(conteudo);
        writer.close();
        
        return true;
    }
    
    public static String GetConfig(String chave) throws IOException
    {
        if (propConfig == null)
        {
            propConfig = new Properties();
            propConfig.load(Util.class.getResourceAsStream("/Resources/config.properties"));
        }

        return propConfig.getProperty(chave);
    }
    
    public static List<Rota> GetRotas()
    {
        if(Util.rotas == null || Util.rotas.size() == 0)
        {
            Util.CarregaRotas();
        }
        
        return Util.rotas;
    }
    
    public static String LeComando(String categoria)
    {
        if(console == null)
        {
            console = new Scanner(System.in);
        }
        
        printa(String.format("[%s]comando=> ",categoria));
        return console.nextLine();
    }
    
    public static void printa(Object obj)
    {
        System.out.print(obj);
    }
    
    public static void printaln(Object obj)
    {
        System.out.println(obj);
    }
    
    public static String primeiraMaiuscula(String palavra)
    {
        palavra = palavra.toLowerCase();
        
        if(palavra.length() > 1)
        {
            return (palavra.substring(0, 1).toUpperCase() + palavra.substring(1));
        }
        else
        {
            return "";
        }
    }
    
}
