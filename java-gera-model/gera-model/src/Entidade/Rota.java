package Entidade;

import java.io.Serializable;

/**
 *
 * @author ronney
 */
public class Rota implements Serializable
{
    private String http;
    private String endereco;
    private String controller;
    private String metodo;
    private String apelido;
    private String rotaPai;
    private String nome;
    
    public Rota()
    {
        
    }
    
    public Rota(String http,String endereco,String controller,String metodo,String apelido)
    {
        this.http = http;
        this.endereco = endereco;
        this.controller = controller;
        this.metodo = metodo;
        this.apelido = apelido;
    }
    
    
    public String GetRota()
    {
        //Rota rota = new Rota("get","adm/sistema","SistemaController","indexSistemas","adm.sistema");
        return String.format("Route::%s('%s','%s@%s')->name('%s');",this.http,this.endereco,this.controller,this.metodo,this.apelido);
    }
    
    
 //------------------- GET e SET ----------------------------------------------

    public String getHttp()
    {
        return http;
    }

    public void setHttp(String http)
    {
        this.http = http;
    }

    public String getEndereco()
    {
        return endereco;
    }

    public void setEndereco(String endereco)
    {
        this.endereco = endereco;
    }

    public String getController()
    {
        return controller;
    }

    public void setController(String controller)
    {
        this.controller = controller;
    }

    public String getMetodo()
    {
        return metodo;
    }

    public void setMetodo(String metodo)
    {
        this.metodo = metodo;
    }

    public String getApelido()
    {
        return apelido;
    }

    public void setApelido(String apelido)
    {
        this.apelido = apelido;
    }
    
    public String getRotaPai()
    {
        if(this.rotaPai == null || this.rotaPai.isEmpty())
        {
            //quebra o apelido da rota nos '.'
            String[] splitPai = this.apelido.split("\\.");
            this.rotaPai = "";

            //encontra a rota pai do sistema
            for(int x = 0; x < splitPai.length-1; x++)
            {
                this.rotaPai += splitPai[x]  + (x != splitPai.length-2 ? "." : "");
            }
        }
        
        return this.rotaPai;
    }
    
    public String getNome()
    {
        if(this.nome == null || this.nome.isEmpty())
        {
            //quebra o apelido da rota nos '.'
            String[] splitPai = this.apelido.split("\\.");
            this.nome = "";

            //encontra a rota pai do sistema
            for(int x = 1; x < splitPai.length; x++)
            {
                this.nome += splitPai[x]  + (x != splitPai.length - 1 ? " " : "");
            }
        }
        
        return Util.primeiraMaiuscula(this.nome);
    }
}
