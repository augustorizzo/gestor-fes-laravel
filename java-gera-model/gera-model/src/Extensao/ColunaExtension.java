/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Extensao;

import Entidade.Coluna;

/**
 *
 * @author ronney
 */
public class ColunaExtension
{
    public static String NomeVariavel(Coluna coluna) throws Exception
    {
        
        String nome = "";
        
        if(coluna.isFk())
        {
            nome = "fk_" + coluna.getForeignKey().getTabela().getNomeArquivo().toLowerCase();
        }
        else
        {
            /*
            String[] split = coluna.getNome().split("_");
            int tamanho = (coluna.isFk() ? split.length -1 : split.length);
            int ini = (coluna.isFk() ? 3 : 1);

            for(int x = ini; x < tamanho; x++)
            {
                String palavra = split[x].toLowerCase();

                nome += palavra;
            }
            */
            
            nome = coluna.getNome();
        }
        
        return nome;        
    }

    public static String NomeCamelCase(Coluna coluna)
    {
        String[] split = coluna.getNome().split("_");
        String nome = "";
        int tamanho = 0;//(coluna.isFk() ? 1 : 0);
        
        for(int x = 0; x < (split.length - tamanho); x++)
        {
            String palavra = split[x].toLowerCase();

            nome += (palavra.substring(0, 1).toUpperCase() + palavra.substring(1));
        }
        
        return nome;
    }
    
    public static String Plural(String palavra)
    {
        String plural = palavra;
        if(("al,el,ol,ul").contains(palavra.substring(palavra.length() - 2, palavra.length())))
        {
            plural = palavra.substring(0,palavra.length() - 1) + "is";
        }
        else if(("ao").contains(palavra.substring(palavra.length() - 2, palavra.length())))
        {
            plural = palavra.substring(0,palavra.length() - 2) + "oes";
        }
        else if(("s").contains(palavra.substring(palavra.length() - 1, palavra.length())))
        {
            plural = palavra + "es";
        }
        else
        {
            plural = palavra + "s";
        }
        
        return plural;
    }
}
